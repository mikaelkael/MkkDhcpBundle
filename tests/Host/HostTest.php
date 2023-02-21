<?php

namespace Mkk\DhcpBundle\Tests\Host;

use InvalidArgumentException;
use Mkk\DhcpBundle\Component\Host\Host;
use PHPUnit\Framework\TestCase;

final class HostTest extends TestCase
{
    public function testAddHost(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Host('hostname with space');
    }
    public function testAddCorrectHostname(): void
    {
        $name = 'h05t_nam3-c0rr3ct';
        $host = new Host($name);
        $this->assertSame($name, $host->getName());
    }
}
