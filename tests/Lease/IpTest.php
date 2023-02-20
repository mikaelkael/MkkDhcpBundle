<?php

namespace Mkk\DhcpBundle\Tests\Lease;

use Mkk\DhcpBundle\Component\Lease\Ip;
use PHPUnit\Framework\TestCase;

final class IpTest extends TestCase
{
    public function testConstructorAndGetAddress(): void
    {
        $address = '1.12.123.234';
        $ip = new Ip($address);

        $this->assertEquals($address, $ip->getAddress());
    }

    public function testConstructorAndGetAddressInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("ip address must be between 0.0.0.0 and 255.255.255.255, got '1.2.3.256'");
        new Ip('1.2.3.256');
    }
}
