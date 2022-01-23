<?php

namespace Mkk\DhcpBundle\Tests\Repository;

use Mkk\DhcpBundle\Repository\HostRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HostRepositoryTest extends WebTestCase
{
    public function testService()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get(HostRepository::class);
        $this->assertTrue($service instanceof HostRepository);
        $this->assertEquals(2, count($service->getHosts()));
    }

    public function testInvalidHostFileUri()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("can't read file '/tmp'");
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get(HostRepository::class);
        $service->setFileUri('/tmp');
        $service->getHosts();
    }

    public function testEmptyHostFile()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("file does not exist 'file:///tmp/noexists'");
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get(HostRepository::class);
        $service->setFileUri('file:///tmp/noexists');
        $service->getHosts();
    }
}
