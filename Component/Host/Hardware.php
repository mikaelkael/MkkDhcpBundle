<?php

namespace Mkk\DhcpBundle\Component\Host;

class Hardware
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $address;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Hardware
    {
        $this->type = $type;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): Hardware
    {
        $this->address = $address;
        return $this;
    }
}
