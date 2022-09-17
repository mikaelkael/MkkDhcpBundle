<?php

namespace Mkk\DhcpBundle\Component\Host;

final class HostFile implements \ArrayAccess, \Countable
{
    /**
     * @var Host[]
     */
    private $hosts = [];

    /**
     * @return Host[]
     */
    public function getHosts(): array
    {
        return $this->hosts;
    }

    public function count(): int
    {
        return \count($this->hosts);
    }

    public function hasHost(string $hostName): bool
    {
        return isset($this->hosts[$hostName]);
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function offsetExists($hostName): bool
    {
        if (!\is_string($hostName)) {
            throw new \InvalidArgumentException(\sprintf("You should access to host file list by string name of an host ('%s' given)", \gettype($hostName)));
        }

        return $this->hasHost($hostName);
    }

    /**
     * @throws \OutOfBoundsException
     */
    public function getHost(string $hostName): Host
    {
        if (!$this->hasHost($hostName)) {
            throw new \OutOfBoundsException();
        }

        return $this->hosts[$hostName];
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function offsetGet($hostName): Host
    {
        if (!\is_string($hostName)) {
            throw new \InvalidArgumentException(\sprintf("You should access to host file list by string name of an host ('%s' given)", \gettype($hostName)));
        }

        return $this->getHost($hostName);
    }

    public function addHost(Host $host): self
    {
        $this->hosts[$host->getName()] = $host;

        return $this;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $host): void
    {
        if (!($host instanceof Host)) {
            throw new \InvalidArgumentException(\sprintf("You should append host to host file as a Host object ('%s' given)", \gettype($host)));
        }

        $this->addHost($host);
    }

    public function removeHost(string $hostName): self
    {
        if (!\is_string($hostName)) {
            throw new \InvalidArgumentException(\sprintf("You should access to host file list by string name of an host ('%s' given)", \gettype($hostName)));
        }
        unset($this->hosts[$hostName]);

        return $this;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function offsetUnset($hostName): void
    {
        if (!\is_string($hostName)) {
            throw new \InvalidArgumentException();
        }
        $this->removeHost($hostName);
    }
}
