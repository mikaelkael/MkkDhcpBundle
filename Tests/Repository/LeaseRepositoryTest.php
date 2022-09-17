<?php

namespace Mkk\DhcpBundle\Tests\Repository;

use Mkk\DhcpBundle\Repository\LeaseRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class LeaseRepositoryTest extends WebTestCase
{
    public function testService(): void
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get(LeaseRepository::class);
        $this->assertTrue($service instanceof LeaseRepository);
        $this->assertCount(35, $service->getLeases());
        $this->assertCount(26, $service->getActiveFreeLeases());
    }
}
