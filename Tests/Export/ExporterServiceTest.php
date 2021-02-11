<?php

namespace Mkk\DhcpBundle\Tests\Export;

use Mkk\DhcpBundle\Component\Export\ConfigExporter;
use Mkk\DhcpBundle\Component\Export\HostExporter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExporterServiceTest extends WebTestCase
{

    public function testHostExporterService()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get(HostExporter::class);
        $this->assertTrue($service instanceof HostExporter);
    }

    public function testConfigExporterService()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get(ConfigExporter::class);
        $this->assertTrue($service instanceof ConfigExporter);
    }
}