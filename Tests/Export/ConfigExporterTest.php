<?php

namespace Mkk\DhcpBundle\Tests\Export;

use Mkk\DhcpBundle\Component\Host\HostFile;
use Mkk\DhcpBundle\Component\Host\Hardware;
use Mkk\DhcpBundle\Component\Host\Host;
use Mkk\DhcpBundle\Component\Export\ConfigExporter;
use PHPUnit\Framework\TestCase;

class ConfigExporterTest extends TestCase
{
    public function testExport()
    {
        $config = new HostFile();

        $host = new Host('test1');
        $host->setHardware((new Hardware())->setType('ethernet')->setAddress('00:01:02:03:04:05'));
        $host->setFixedAddress('1.2.3.4');
        $host->setDdnsHostname('test1');
        $config->addHost($host);

        $host = new Host('test2');
        $host->setHardware((new Hardware())->setType('ethernet')->setAddress('01:02:03:04:05:06'));
        $host->setFixedAddress('2.3.4.5');
        $host->setDdnsHostname('test2');
        $config->addHost($host);

        $expected =
            "host test1 {
\thardware ethernet 00:01:02:03:04:05;
\tfixed-address 1.2.3.4;
\tddns-hostname \"test1\";
}

host test2 {
\thardware ethernet 01:02:03:04:05:06;
\tfixed-address 2.3.4.5;
\tddns-hostname \"test2\";
}
";

        $exporter = new ConfigExporter();
        $this->assertEquals($expected, $exporter->export($config));
    }

    public function testExportEmpty()
    {
        $config = new HostFile();

        $exporter = new ConfigExporter();
        $this->assertEquals('', $exporter->export($config));
    }
}
