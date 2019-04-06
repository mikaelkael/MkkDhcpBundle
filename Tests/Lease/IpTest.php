<?php

namespace Mkk\DhcpBundle\Tests\Lease;

use Mkk\DhcpBundle\Component\Lease\Ip;
use PHPUnit\Framework\TestCase;

class IpTest extends TestCase
{
    public function testConstructorAndGetAddress()
    {
        $address = '1.12.123.234';
        $ip      = new Ip($address);

        $this->assertEquals($address, $ip->getAddress());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage ip address must be between 0.0.0.0 and 255.255.255.255, got '1.2.3.256'
     */
    public function testConstructorAndGetAddressInvalid()
    {
        new Ip('1.2.3.256');
    }
}
