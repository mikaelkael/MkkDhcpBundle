<?php

namespace Mkk\DhcpBundle\Tests\Parser;

use Mkk\DhcpBundle\Component\Lease\LeaseFile;
use Mkk\DhcpBundle\Component\Parser\FormatException;
use Mkk\DhcpBundle\Component\Parser\LeaseParser;
use PHPUnit\Framework\TestCase;

final class LeaseParserTest extends TestCase
{
    public function testParse(): void
    {
        $source = \file_get_contents(__DIR__.'/../Fixtures/dhcpd.leases');
        $parser = new LeaseParser();
        $config = $parser->parse($source);

        $this->assertInstanceOf(LeaseFile::class, $config);

        $lease = $config->getLeases();
        $this->assertCount(35, $lease);
        $this->assertArrayHasKey('192.168.33.200', $lease);
        $this->assertArrayHasKey('192.168.33.234', $lease);

        $vpn = $config['192.168.33.200']; // test ArrayAccess
        $this->assertEquals('2016-03-11 13:44:55', $vpn->getStarts()->format('Y-m-d H:i:s'));
        $this->assertEquals('00:16:3e:8f:e4:dc', $vpn->getHardware()->getAddress());
        $this->assertEquals('192.168.33.200', $vpn->getIp()->getAddress());

        $vpn = $lease['192.168.33.201']; // test full list by key
        $this->assertEquals('2016-03-11 17:18:35', $vpn->getStarts()->format('Y-m-d H:i:s'));
        $this->assertEquals('00:16:3e:40:1f:d6', $vpn->getHardware()->getAddress());
        $this->assertEquals('192.168.33.201', $vpn->getIp()->getAddress());
        $this->assertEquals('unifi', $vpn->getClientHostname());
    }

    public function testParseEmpty(): void
    {
        $parser = new LeaseParser();
        $config = $parser->parse('');

        $this->assertEmpty($config->getLeases());
    }

    public function testParseWithUnknownConfiguration(): void
    {
        $source = \file_get_contents(__DIR__.'/../Fixtures/dhcpd_with_unkown_parameters.leases');
        $parser = new LeaseParser();
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage("Unknown configuration: 'set newdata' (with parameters: '\"new\"')");
        $parser->parse($source);
    }

    public function testParseWithUnknownConfigurationAndDisableException(): void
    {
        $source = \file_get_contents(__DIR__.'/../Fixtures/dhcpd_with_unkown_parameters.leases');
        $parser = new LeaseParser();
        $parser->setThrowExceptionOnParseError(false);
        $config = $parser->parse($source);

        $this->assertInstanceOf(LeaseFile::class, $config);

        $lease = $config->getLeases();
        $this->assertCount(1, $lease);
        $this->assertArrayHasKey('192.168.33.200', $lease);

        $vpn = $config['192.168.33.200']; // test ArrayAccess
        $this->assertEquals('2016-04-11 20:36:15', $vpn->getStarts()->format('Y-m-d H:i:s'));
        $this->assertEquals('00:16:3e:6e:17:a3', $vpn->getHardware()->getAddress());
        $this->assertEquals('192.168.33.200', $vpn->getIp()->getAddress());
    }
}
