<?php

namespace Mkk\DhcpBundle\Component\Export;

use Mkk\DhcpBundle\Component\Host\Hardware;
use Mkk\DhcpBundle\Component\Host\Host;

class HostExporter
{
    /**
     * @param Host $host
     * @param int $depth
     * @return string
     */
    public function export(Host $host, $depth = 0)
    {
        $depth  = (int)$depth;
        $result = str_repeat("\t", $depth) . 'host ' . $host->getName() . " {\n";
        $result .= str_repeat("\t", $depth + 1) . $this->exportHardware($host->getHardware());
        $result .= str_repeat("\t", $depth + 1) . 'fixed-address ' . join(', ', $host->getFixedAddress()) . ";\n";
        $result .= str_repeat("\t", $depth + 1) . "ddns-hostname \"" . $host->getDdnsHostname() . "\";\n";
        $result .= str_repeat("\t", $depth) . "}\n";

        return $result;
    }

    private function exportHardware(Hardware $hardware)
    {
        return 'hardware ' . $hardware->getType() . ' ' . $hardware->getAddress() . ";\n";
    }
}
