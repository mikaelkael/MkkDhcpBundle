<?php

namespace Mkk\DhcpBundle\Component\Parser;

use Mkk\DhcpBundle\Component\Host\Hardware;
use Mkk\DhcpBundle\Component\Lease\Lease;
use Mkk\DhcpBundle\Component\Lease\LeaseFile;
use Symfony\Component\String\UnicodeString;

final class LeaseParser extends AbstractParser
{
    /**
     * @throws FormatException
     */
    public function parse(string $source): LeaseFile
    {
        $leaseFile = new LeaseFile();

        if ('' == $source) {
            return $leaseFile;
        }

        \preg_match_all('/\s*lease\s*"?(([0-9]{1,3}\.){3}[0-9]{1,3})"?\s*\{(.*?)\}/sm', $source, $matches);
        foreach ($matches[3] as $k => $params) {
            $lease = new Lease($matches[1][$k]);
            foreach (\explode(';', $params) as $p) {
                if ('' != \trim($p)) {
                    $list = \preg_split('~(?<!\\\\)(?:\\\\{2})*"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"(*SKIP)(*F)|\s+~s', \trim($p));
                    $key = \array_shift($list);
                    switch ($key) {
                        case 'starts':
                        case 'ends':
                        case 'tstp':
                        case 'cltt':
                            if ('never' != $list[0]) {
                                $lease->{'set'.\ucfirst($key)}(new \DateTime(\str_replace('/', '-', $list[1]).' '.$list[2]));
                            }
                            break;
                        case 'uid':
                        case 'client-hostname':
                        case 'dynamic-bootp':
                            $u = new UnicodeString($key);
                            $lease->{'set'.$u->camel()->title()}(isset($list[0]) ? \trim($list[0], '"') : null);
                            break;
                        case 'set':
                            $u = new UnicodeString($list[0]);
                            $lease->{'set'.$u->camel()->title()}(\trim($list[2], '"'));
                            break;
                        case 'binding':
                            $lease->setBindingState($list[1]);
                            break;
                        case 'next':
                            $lease->setNextBindingState($list[2]);
                            break;
                        case 'rewind':
                            $lease->setRewindBindingState($list[2]);
                            break;
                        case 'hardware':
                            $lease->setHardware((new Hardware())->setType($list[0])->setAddress($list[1]));
                            break;
                        default:
                            throw new FormatException(\sprintf("Unknown configuration: '%s' (with parameters: '%s')", $key, \implode(', ', $list)));
                    }
                }
            }
            $leaseFile->addLease($lease);
        }

        return $leaseFile;
    }
}
