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
    public function offsetExists($offset): bool
    {
        if (!\is_string($offset)) {
            throw new \InvalidArgumentException(\sprintf("You should access to host file list by string name of an host ('%s' given)", \gettype($offset)));
        }

        return $this->hasHost($offset);
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
    public function offsetGet($offset): Host
    {
        if (!\is_string($offset)) {
            throw new \InvalidArgumentException(\sprintf("You should access to host file list by string name of an host ('%s' given)", \gettype($offset)));
        }

        return $this->getHost($offset);
    }

    public function addHost(Host $host): self
    {
        $this->hosts[$host->getName()] = $host;

        return $this;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function offsetSet($offset, $value): void
    {
        if (!($value instanceof Host)) {
            throw new \InvalidArgumentException(\sprintf("You should append host to host file as a Host object ('%s' given)", \gettype($value)));
        }

        $this->addHost($value);
    }

    public function removeHost(string $hostName): self
    {
        unset($this->hosts[$hostName]);

        return $this;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function offsetUnset($offset): void
    {
        if (!\is_string($offset)) {
            throw new \InvalidArgumentException();
        }
        $this->removeHost($offset);
    }
}
