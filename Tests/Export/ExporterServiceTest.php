<?php

namespace Mkk\DhcpBundle\Tests\Export;

use Mkk\DhcpBundle\Component\Export\ConfigExporter;
use Mkk\DhcpBundle\Component\Export\HostExporter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ExporterServiceTest extends WebTestCase
{
    public function testHostExporterService(): void
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get(HostExporter::class);
        $this->assertTrue($service instanceof HostExporter);
    }

    public function testConfigExporterService(): void
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get(ConfigExporter::class);
        $this->assertTrue($service instanceof ConfigExporter);
    }
}
