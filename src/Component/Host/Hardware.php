<?php

namespace Mkk\DhcpBundle\Component\Host;

final class Hardware
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $address;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
