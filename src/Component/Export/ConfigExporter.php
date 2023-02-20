<?php

namespace Mkk\DhcpBundle\Component\Export;

use Mkk\DhcpBundle\Component\Host\HostFile;

final class ConfigExporter
{
    /**
     * @var HostExporter
     */
    private $hostExporter;

    public function __construct()
    {
        $this->hostExporter = new HostExporter();
    }

    public function export(HostFile $config, int $depth = 0): string
    {
        $result = [];
        foreach ($config->getHosts() as $host) {
            $result[] = $this->hostExporter->export($host, $depth);
        }

        return \implode("\n", $result);
    }
}
