<?php

namespace Mkk\DhcpBundle\Tests\Repository;

use Mkk\DhcpBundle\Repository\LeaseRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LeaseRepositoryTest extends WebTestCase
{
    public function testService()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get(LeaseRepository::class);
        $this->assertTrue($service instanceof LeaseRepository);
        $this->assertEquals(10, count($service->getLeases()));
        $this->assertEquals(1, count($service->getActiveFreeLeases()));
    }
}
