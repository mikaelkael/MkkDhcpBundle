<?php

namespace Mkk\DhcpBundle\Component\Lease;

final class LeaseFile implements \Countable
{
    /**
     * @var Lease[]
     */
    private $leases = [];

    /**
     * @return Lease[]
     */
    public function getLeases(): array
    {
        return $this->leases;
    }

    public function count()
    {
        return \count($this->leases);
    }

    public function addLease(Lease $lease): self
    {
        if (null === $lease->getIp()) {
            throw new \InvalidArgumentException('no lease ip');
        }

        $this->leases[$lease->getIp()->getAddress()] = $lease;
        $this->sort();

        return $this;
    }

    public function removeLease(Ip $ip): self
    {
        unset($this->leases[$ip->getAddress()]);

        return $this;
    }

    private function sort(): void
    {
        \uksort($this->leases, function ($address1, $address2) {
            $ip1 = ip2long($address1);
            $ip2 = ip2long($address2);
            if ($ip1 !== $ip2) {
                return $ip1 - $ip2;
            }
            return 0;
        });
    }
}
