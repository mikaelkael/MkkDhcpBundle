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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Hardware
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Hardware
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
}
