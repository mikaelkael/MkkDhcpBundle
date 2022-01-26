<?php

namespace Mkk\DhcpBundle\Component\Parser;

use Mkk\DhcpBundle\Component\Host\Hardware;
use Mkk\DhcpBundle\Component\Host\Host;
use Mkk\DhcpBundle\Component\Host\HostFile;

final class HostParser extends AbstractParser
{
    /**
     * @throws FormatException
     */
    public function parse(string $source): HostFile
    {
        $hostFile = new HostFile();

        if ('' == $source) {
            return $hostFile;
        }

        \preg_match_all('/\s*host\s*"?([A-Za-z0-9\-\_]*)"?\s*\{(.*?)\}/sm', $source, $matches);
        foreach ($matches[2] as $k => $params) {
            $host = new Host($matches[1][$k]);
            foreach (\explode(';', $params) as $p) {
                if ('' != \trim($p)) {
                    $list = \preg_split('~(?<!\\\\)(?:\\\\{2})*"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"(*SKIP)(*F)|\s+~s', \trim($p));
                    $key = \array_shift($list);
                    switch ($key) {
                        case 'hardware':
                            $host->setHardware((new Hardware())->setType($list[0])->setAddress($list[1]));
                            break;
                        case 'fixed-address':
                            $addresses = \explode(',', \implode('', $list));
                            $host->setFixedAddress($addresses);
                            break;
                        case 'ddns-hostname':
                            $host->setDdnsHostname(\trim($list[0], "\"\'"));
                            break;
                        default:
                            throw new FormatException(\sprintf("Unknown configuration: '%s' (with parameters: '%s')", $key, \implode(', ', $list)));
                    }
                }
            }
            $hostFile->addHost($host);
        }

        return $hostFile;
    }
}
