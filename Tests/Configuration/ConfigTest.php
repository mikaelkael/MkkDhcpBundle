<?php

namespace Mkk\DhcpBundle\Tests\Configuration;

use Mkk\DhcpBundle\Component\Host\HostFile;
use Mkk\DhcpBundle\Component\Host\Host;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testGetHosts()
    {
        $config = new HostFile();
        $this->assertEmpty($config->getHosts());

        $host1 = new Host('test1');
        $config->addHost($host1);
        $host2 = new Host('test2');
        $config->addHost($host2);

        $hosts = $config->getHosts();
        $this->assertCount(2, $hosts);
        $this->assertEquals([$host1->getName() => $host1, $host2->getName() => $host2], $hosts);
    }

    public function testAddHost()
    {
        $config = new HostFile();
        $host   = new Host('test');
        $config->addHost($host);

        $hosts = $config->getHosts();
        $this->assertCount(1, $hosts);
        $this->assertArrayHasKey($host->getName(), $hosts);
        $this->assertSame($host, $hosts[$host->getName()]);
    }

    public function testAddHostWithSameName()
    {
        $config = new HostFile();
        $host1  = new Host('test');
        $host1->setDdnsHostname('test1');
        $host2 = new Host('test');
        $host2->setDdnsHostname('test2');
        $config->addHost($host1);
        $config->addHost($host2);

        $hosts = $config->getHosts();
        $this->assertCount(1, $hosts);
        $this->assertSame($host2, $hosts[$host2->getName()]);
    }

    public function testRemoveHost()
    {
        $config = new HostFile();
        $host   = new Host('test');
        $config->addHost($host);

        $this->assertCount(1, $config->getHosts());

        $config->removeHost($host->getName());

        $this->assertEmpty($config->getHosts());
    }

    public function testHasHostNotContains()
    {
        $config = new HostFile();

        $this->assertFalse($config->hasHost('test'));
    }

    public function testHasHostContains()
    {
        $config = new HostFile();
        $config->addHost(new Host('test'));

        $this->assertTrue($config->hasHost('test'));
    }

    public function testGetHost()
    {
        $config = new HostFile();
        $host   = new Host('test');
        $config->addHost($host);

        $this->assertSame($host, $config->getHost('test'));
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testGetHostNotContains()
    {
        $config = new HostFile();
        $config->getHost('test');
    }
}
