<?php

namespace Mkk\DhcpBundle\Component\Lease;

final class LeaseFile
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
            $parts1 = \explode('.', $address1);
            $parts2 = \explode('.', $address2);
            for ($i = 0; $i < 4; ++$i) {
                $part1 = (int) $parts1[$i];
                $part2 = (int) $parts2[$i];
                if ($part1 !== $part2) {
                    return $part1 - $part2;
                }
            }

            return 0;
        });
    }
}
