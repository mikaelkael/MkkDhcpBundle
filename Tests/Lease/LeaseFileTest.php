<?php

namespace Mkk\DhcpBundle\Tests\Lease;


use Mkk\DhcpBundle\Component\Lease\Ip;
use Mkk\DhcpBundle\Component\Lease\Lease;
use Mkk\DhcpBundle\Component\Lease\LeaseFile;
use PHPUnit\Framework\TestCase;

class LeaseFileTest extends TestCase
{
    public function testAddLease()
    {
        $leaseFile = new LeaseFile();
        $lease     = new Lease();
        $address   = '1.2.3.4';
        $lease->setIp(new Ip($address));
        $leaseFile->addLease($lease);

        $leases = $leaseFile->getLeases();
        $this->assertCount(1, $leases);
        $this->assertArrayHasKey($address, $leases);
        $this->assertSame($lease, $leases[$address]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage no lease ip
     */
    public function testAddLeaseNoIp()
    {
        $leaseFile = new LeaseFile();
        $leaseFile->addLease(new Lease());
    }

    public function testRemoveLease()
    {
        $leaseFile = new LeaseFile();
        $lease     = new Lease();
        $address   = '1.2.3.4';
        $lease->setIp(new Ip($address));
        $leaseFile->addLease($lease);

        $this->assertCount(1, $leaseFile->getLeases());

        $leaseFile->removeLease($lease->getIp());

        $this->assertEmpty($leaseFile->getLeases());
    }
}
