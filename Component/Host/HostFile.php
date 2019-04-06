<?php

namespace Mkk\DhcpBundle\Component\Host;

class HostFile
{
    /**
     * @var Host[]
     */
    private $hosts = [];

    /**
     * @return Host[]
     */
    public function getHosts()
    {
        return $this->hosts;
    }

    /**
     * @param string $hostName
     * @return bool
     */
    public function hasHost($hostName)
    {
        return isset($this->hosts[$hostName]);
    }

    /**
     * @param string $hostName
     * @return Host
     * @throws \OutOfBoundsException
     */
    public function getHost($hostName)
    {
        if (!$this->hasHost($hostName)) {
            throw new \OutOfBoundsException($hostName);
        }

        return $this->hosts[$hostName];
    }

    /**
     * @param Host $host
     * @return HostFile
     */
    public function addHost(Host $host)
    {
        $this->hosts[$host->getName()] = $host;
        return $this;
    }

    /**
     * @param string $hostName
     * @return HostFile
     */
    public function removeHost($hostName)
    {
        unset($this->hosts[$hostName]);
        return $this;
    }
}
