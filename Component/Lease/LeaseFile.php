<?php

namespace Mkk\DhcpBundle\Component\Lease;

final class LeaseFile implements \ArrayAccess, \Countable
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

    public function count(): int
    {
        return \count($this->leases);
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function hasLease($address): bool
    {
        if ($address instanceof Ip) {
            $address = $address->getAddress();
        }
        if (\is_string($address)) {
            return \array_key_exists($address, $this->leases);
        }
        throw new \InvalidArgumentException(\sprintf("You should access to lease file list by string address or Ip object ('%s' given)", \gettype($address)));
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function offsetExists($address): bool
    {
        return $this->hasLease($address);
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function offsetGet($address): Lease
    {
        if ($address instanceof Ip) {
            $address = $address->getAddress();
        }
        if (\is_string($address)) {
            return $this->getLease($address);
        }
        throw new \InvalidArgumentException(\sprintf("You should access to lease file list by string address or Ip object ('%s' given)", \gettype($address)));
    }

    /**
     * @throws \OutOfBoundsException
     */
    public function getLease($address): Lease
    {
        if ($address instanceof Ip) {
            $address = $address->getAddress();
        }
        if (!$this->hasLease($address)) {
            throw new \OutOfBoundsException();
        }

        return $this->leases[$address];
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

    /**
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $lease): void
    {
        if (!($lease instanceof Lease)) {
            throw new \InvalidArgumentException(\sprintf("You should append lease to lease file as a Lease object ('%s' given)", \gettype($lease)));
        }

        $this->addLease($lease);
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function removeLease($address): self
    {
        if ($address instanceof Ip) {
            $address = $address->getAddress();
        }
        if (!\is_string($address)) {
            throw new \InvalidArgumentException(\sprintf("You should access to lease file list by string address or Ip object ('%s' given)", \gettype($address)));
        }
        unset($this->leases[$address]);

        return $this;
    }

    public function offsetUnset($adresse): void
    {
        $this->removeLease($adresse);
    }

    private function sort(): void
    {
        \uksort($this->leases, function ($address1, $address2) {
            $ip1 = \ip2long($address1);
            $ip2 = \ip2long($address2);
            if ($ip1 !== $ip2) {
                return $ip1 - $ip2;
            }

            return 0;
        });
    }
}
