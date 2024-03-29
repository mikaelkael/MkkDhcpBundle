<?php

namespace Mkk\DhcpBundle\Tests\Parser;

use Mkk\DhcpBundle\Component\Host\HostFile;
use Mkk\DhcpBundle\Component\Parser\HostParser;
use PHPUnit\Framework\TestCase;

final class HostParserTest extends TestCase
{
    public function testParse(): void
    {
        $source = \file_get_contents(__DIR__.'/../Fixtures/hosts.conf');
        $parser = new HostParser();
        $config = $parser->parse($source);

        $this->assertInstanceOf(HostFile::class, $config);

        $hosts = $config->getHosts();
        $this->assertCount(4, $hosts);
        $this->assertArrayHasKey('test1', $hosts);
        $this->assertArrayHasKey('test2', $hosts);

        $vpn = $config['test1']; // test ArrayAccess
        $this->assertEquals('test1', $vpn->getName());
        $this->assertEquals('ethernet', $vpn->getHardware()->getType());
        $this->assertEquals('00:01:02:03:04:05', $vpn->getHardware()->getAddress());
        $this->assertEquals(['1.2.3.4'], $vpn->getFixedAddress());
        $this->assertEquals('test1', $vpn->getDdnsHostname());

        $vpn = $hosts['test2']; // test full list by key
        $this->assertEquals('test2', $vpn->getName());
        $this->assertEquals('ethernet', $vpn->getHardware()->getType());
        $this->assertEquals('01:02:03:04:05:06', $vpn->getHardware()->getAddress());
        $this->assertEquals(['2.3.4.5'], $vpn->getFixedAddress());
        $this->assertEquals('test2', $vpn->getDdnsHostname());

        $vpn = $config['test-3'];
        $this->assertEquals('test-3', $vpn->getName());
        $this->assertEquals('ethernet', $vpn->getHardware()->getType());
        $this->assertEquals('02:03:04:05:06:07', $vpn->getHardware()->getAddress());
        $this->assertEquals(['3.4.5.6', '4.5.6.7'], $vpn->getFixedAddress());
        $this->assertEquals('test3', $vpn->getDdnsHostname());

        $vpn = $hosts['test-4'];
        $this->assertEquals('test-4', $vpn->getName());
        $this->assertEquals('ethernet', $vpn->getHardware()->getType());
        $this->assertEquals('03:04:05:06:07:08', $vpn->getHardware()->getAddress());
        $this->assertEquals(['5.6.7.8', '6.7.8.9'], $vpn->getFixedAddress());
        $this->assertNull($vpn->getDdnsHostname());
    }

    public function testParseEmpty(): void
    {
        $parser = new HostParser();
        $config = $parser->parse('');

        $this->assertEmpty($config->getHosts());
    }
}
