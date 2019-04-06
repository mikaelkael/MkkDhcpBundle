<?php

namespace Mkk\DhcpBundle\Component\Export;

use Mkk\DhcpBundle\Component\Host\HostFile;

class ConfigExporter
{
    /**
     * @var HostExporter
     */
    private $hostExporter;

    public function __construct()
    {
        $this->hostExporter = new HostExporter();
    }

    /**
     * @param HostFile $config
     * @param int $depth
     * @return string
     */
    public function export(HostFile $config, $depth = 0)
    {
        $result = '';
        foreach ($config->getHosts() as $host) {
            if (!empty($result)) {
                $result .= "\n";
            }
            $result .= $this->hostExporter->export($host, $depth);
        }

        return $result;
    }
}
