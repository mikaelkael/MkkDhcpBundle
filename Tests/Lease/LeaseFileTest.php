<?php

namespace Mkk\DhcpBundle\Tests\Lease;

use Mkk\DhcpBundle\Component\Lease\Ip;
use Mkk\DhcpBundle\Component\Lease\Lease;
use Mkk\DhcpBundle\Component\Lease\LeaseFile;
use PHPUnit\Framework\TestCase;

final class LeaseFileTest extends TestCase
{
    public function testAddLease(): void
    {
        $leaseFile = new LeaseFile();
        $lease = new Lease();
        $lease->setIp(new Ip('1.2.3.4'));
        $leaseFile->addLease($lease);
        $leaseFile[] = new Lease('2.3.4.5');
        $leaseFile[] = new Lease(new Ip('3.4.5.6'));

        $leases = $leaseFile->getLeases();
        $this->assertCount(3, $leases);
        $this->assertArrayHasKey('1.2.3.4', $leases);
        $this->assertSame($lease, $leases['1.2.3.4']);

        $this->assertCount(3, $leaseFile);
        $this->assertArrayHasKey('2.3.4.5', $leaseFile);
        $this->assertSame($lease, $leaseFile['1.2.3.4']);
    }

    public function testAddLeaseNoIp(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('no lease ip');
        $leaseFile = new LeaseFile();
        $leaseFile->addLease(new Lease());
    }

    public function testRemoveLease(): void
    {
        $leaseFile = new LeaseFile();
        $lease = new Lease();
        $address = '1.2.3.4';
        $lease->setIp(new Ip($address));
        $leaseFile->addLease($lease);

        $this->assertCount(1, $leaseFile->getLeases());

        $leaseFile->removeLease($lease->getIp());

        $this->assertEmpty($leaseFile->getLeases());
    }

    public function testOrderOfLeaseFile(): void
    {
        $leaseFile = new LeaseFile();
        $lease = new Lease();
        $lease->setIp(new Ip('2.3.4.5'));
        $leaseFile->addLease($lease);
        $lease = new Lease();
        $lease->setIp(new Ip('1.2.3.4'));
        $leaseFile->addLease($lease);
        $lease = new Lease();
        $lease->setIp(new Ip('1.1.3.4'));
        $leaseFile->addLease($lease);

        $this->assertEquals(['1.1.3.4', '1.2.3.4', '2.3.4.5'], array_keys($leaseFile->getLeases()));
    }
}
