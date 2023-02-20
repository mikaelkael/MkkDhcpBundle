<?php

namespace Mkk\DhcpBundle\Component\Lease;

final class Ip
{
    /**
     * @var string
     */
    private $address;

    public function __construct(string $address)
    {
        if (1 !== \preg_match('/^(1?\\d{1,2}|2([0-4]\\d|5[0-5]))(\.(1?\\d{1,2}|2([0-4]\\d|5[0-5]))){3}$/', $address)) {
            throw new \InvalidArgumentException(\sprintf("ip address must be between 0.0.0.0 and 255.255.255.255, got '%s'", $address));
        }
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
