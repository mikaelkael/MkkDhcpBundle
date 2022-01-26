<?php

namespace Mkk\DhcpBundle\Component\Export;

use Mkk\DhcpBundle\Component\Host\Hardware;
use Mkk\DhcpBundle\Component\Host\Host;

final class HostExporter
{
    public function export(Host $host, int $depth = 0): string
    {
        $depth = (int) $depth;
        $result = \str_repeat("\t", $depth).'host '.$host->getName()." {\n";
        $result .= \str_repeat("\t", $depth + 1).$this->exportHardware($host->getHardware());
        $result .= \str_repeat("\t", $depth + 1).'fixed-address '.\implode(', ', $host->getFixedAddress()).";\n";
        $result .= \str_repeat("\t", $depth + 1).'ddns-hostname "'.$host->getDdnsHostname()."\";\n";
        $result .= \str_repeat("\t", $depth)."}\n";

        return $result;
    }

    private function exportHardware(Hardware $hardware): string
    {
        return 'hardware '.$hardware->getType().' '.$hardware->getAddress().";\n";
    }
}
