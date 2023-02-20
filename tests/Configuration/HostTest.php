<?php

namespace Mkk\DhcpBundle\Tests\Configuration;

use Mkk\DhcpBundle\Component\Host\Hardware;
use Mkk\DhcpBundle\Component\Host\Host;
use PHPUnit\Framework\TestCase;

final class HostTest extends TestCase
{
    public function testGetAndSetName(): void
    {
        $host = new Host();
        $hostname = 'test';
        $host->setName($hostname);

        $this->assertEquals($hostname, $host->getName());
    }

    public function testGetAndSetHardware(): void
    {
        $host = new Host();
        $hw = new Hardware('ethernet', '00:00:00:00:00:00');
        $host->setHardware($hw);

        $this->assertSame($hw, $host->getHardware());
    }

    public function testGetAndSetFixedAddressSingle(): void
    {
        $host = new Host();
        $address = '1.2.3.4';
        $host->setFixedAddress($address);

        $this->assertEquals([$address], $host->getFixedAddress());
    }

    public function testGetAndSetFixedAddressMultiple(): void
    {
        $host = new Host();
        $address = ['1.2.3.4', 'example.com'];
        $host->setFixedAddress($address);

        $this->assertEquals($address, $host->getFixedAddress());
    }

    public function testGetAndSetDdnsHostname(): void
    {
        $host = new Host();
        $hostname = 'test';
        $host->setDdnsHostname($hostname);

        $this->assertEquals($hostname, $host->getDdnsHostname());
    }
}
