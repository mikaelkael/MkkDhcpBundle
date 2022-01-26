<?php

namespace Mkk\DhcpBundle\Component\Host;

final class Host
{
    /**
     * @var ?string
     */
    private $name;

    /**
     * @var Hardware
     */
    private $hardware;

    /**
     * @var string[]
     */
    private $fixedAddress;

    /**
     * @var string
     */
    private $ddnsHostname;

    public function __construct(string $name = null)
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHardware(): Hardware
    {
        return $this->hardware;
    }

    public function setHardware(Hardware $hardware): self
    {
        $this->hardware = $hardware;

        return $this;
    }

    public function getFixedAddress(): ?array
    {
        return $this->fixedAddress;
    }

    public function setFixedAddress($fixedAddress): self
    {
        $this->fixedAddress = (array) $fixedAddress;

        return $this;
    }

    public function getDdnsHostname(): ?string
    {
        return $this->ddnsHostname;
    }

    public function setDdnsHostname(string $ddnsHostname): self
    {
        $this->ddnsHostname = $ddnsHostname;

        return $this;
    }

    public function getDnsHostname(): array
    {
        $hostByAddr = [];
        foreach ($this->fixedAddress as $address) {
            $hostByAddr[] = \gethostbyaddr($address);
        }

        return $hostByAddr;
    }
}
