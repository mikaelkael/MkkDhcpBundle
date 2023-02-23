<?php

namespace Mkk\DhcpBundle\Tests\Host;

use InvalidArgumentException;
use Mkk\DhcpBundle\Component\Host\Host;
use PHPUnit\Framework\TestCase;

final class HostTest extends TestCase
{
    public function testAddBadHostWithSpace(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Host('hostname with space');
    }

    public function testAddBadHostBeginningByUnderscore(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Host('_hostname_beginning_by_underscore');
    }

    public function testAddCorrectHostname(): void
    {
        $name = 'h05t_nam3-c0rr3ct';
        $host = new Host($name);
        $this->assertSame($name, $host->getName());
    }
}
