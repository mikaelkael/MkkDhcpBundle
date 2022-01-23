<?php

namespace Mkk\DhcpBundle\Component\Host;

class HostFile
{
    /**
     * @var Host[]
     */
    private $hosts = [];

    public function getHosts()
    {
        return $this->hosts;
    }

    public function hasHost(string $hostName): bool
    {
        return isset($this->hosts[$hostName]);
    }

    /**
     * @throws \OutOfBoundsException
     */
    public function getHost(string $hostName): Host
    {
        if (!$this->hasHost($hostName)) {
            throw new \OutOfBoundsException($hostName);
        }

        return $this->hosts[$hostName];
    }

    public function addHost(Host $host): HostFile
    {
        $this->hosts[$host->getName()] = $host;
        return $this;
    }

    public function removeHost(string $hostName): HostFile
    {
        unset($this->hosts[$hostName]);
        return $this;
    }
}
