<?php

namespace Mkk\DhcpBundle\Tests\Host;

use Mkk\DhcpBundle\Component\Host\Host;
use Mkk\DhcpBundle\Component\Host\HostFile;
use PHPUnit\Framework\TestCase;

final class HostFileTest extends TestCase
{
    public function testAddHost(): void
    {
        $hostFile = new HostFile();
        $host1 = new Host('test1');
        $hostFile->addHost($host1);
        $host2 = new Host('test2');
        $hostFile[] = $host2;
        $this->assertCount(2, $hostFile);
        $this->assertInstanceOf(Host::class, $hostFile->getHost('test1'));
        $this->assertInstanceOf(Host::class, $hostFile['test2']);
    }

    public function testAccessToUnknownHost(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $hostFile = new HostFile();
        $hostFile->getHost('test');
    }

    public function testAccessToUnknownHostByArrayAccess(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $hostFile = new HostFile();
        $hostFile['test'];
    }

    public function testAccessToUnknownNotStringHostByArrayAccess(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("You should access to host file list by string name of an host ('double' given)");
        $hostFile = new HostFile();
        $hostFile[1.0];
    }
}
