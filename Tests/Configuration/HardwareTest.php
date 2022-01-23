<?php

namespace Mkk\DhcpBundle\Tests\Configuration;

use Mkk\DhcpBundle\Component\Host\Hardware;
use PHPUnit\Framework\TestCase;

class HardwareTest extends TestCase
{
    public function testConstructor()
    {
        $type    = 'ethernet';
        $address = '00:01:02:03:04:05';
        $hw      = (new Hardware())->setType($type)->setAddress($address);

        $this->assertEquals($type, $hw->getType());
        $this->assertEquals($address, $hw->getAddress());
    }
}
