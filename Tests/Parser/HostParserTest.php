<?php

namespace Mkk\DhcpBundle\Tests\Parser;

use Mkk\DhcpBundle\Component\Host\HostFile;
use Mkk\DhcpBundle\Component\Parser\HostParser;
use PHPUnit\Framework\TestCase;

class HostParserTest extends TestCase
{
    public function testParse()
    {
        $source = file_get_contents(__DIR__ . '/../Fixtures/hosts.conf');
        $parser = new HostParser();
        $config = $parser->parse($source);

        $this->assertInstanceOf(HostFile::class, $config);

        $hosts = $config->getHosts();
        $this->assertCount(2, $hosts);
        $this->assertArrayHasKey('test1', $hosts);
        $this->assertArrayHasKey('test2', $hosts);

        $vpn = $hosts['test1'];
        $this->assertEquals('test1', $vpn->getName());
        $this->assertEquals('ethernet', $vpn->getHardware()->getType());
        $this->assertEquals('00:01:02:03:04:05', $vpn->getHardware()->getAddress());
        $this->assertEquals(['1.2.3.4'], $vpn->getFixedAddress());
        $this->assertEquals('test1', $vpn->getDdnsHostname());

        $vpn = $hosts['test2'];
        $this->assertEquals('test2', $vpn->getName());
        $this->assertEquals('ethernet', $vpn->getHardware()->getType());
        $this->assertEquals('01:02:03:04:05:06', $vpn->getHardware()->getAddress());
        $this->assertEquals(['2.3.4.5'], $vpn->getFixedAddress());
        $this->assertEquals('test2', $vpn->getDdnsHostname());
    }

    public function testParseEmpty()
    {
        $parser = new HostParser();
        $config = $parser->parse('');

        $this->assertEmpty($config->getHosts());
    }
}
