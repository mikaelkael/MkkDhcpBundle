<?php

namespace Mkk\DhcpBundle\Component\Lease;

use Mkk\DhcpBundle\Component\Host\Hardware;

final class Lease
{
    /**
     * @var Ip
     */
    private $ip;

    /**
     * @var \DateTime
     */
    private $starts;

    /**
     * @var \DateTime
     */
    private $ends;

    /**
     * @var \DateTime
     */
    private $tstp;

    /**
     * @var \DateTime
     */
    private $tsfp;

    /**
     * @var \DateTime
     */
    private $atsfp;

    /**
     * @var \DateTime
     */
    private $cltt;

    /**
     * @var string
     */
    private $bindingState;

    /**
     * @var string
     */
    private $nextBindingState;

    /**
     * @var string
     */
    private $rewindBindingState;

    /**
     * @var Hardware
     */
    private $hardware;

    /**
     * @var string
     */
    private $clientHostname;

    /**
     * @var string
     */
    private $uid;

    /**
     * @var string
     */
    private $vendorClass;

    /**
     * @var string
     */
    private $vendorClassIdentifier;

    /**
     * @var string
     */
    private $ddnsFwdName;

    /**
     * @var string
     */
    private $ddnsRevName;

    /**
     * @var string
     */
    private $ddnsTxt;

    /**
     * @var bool
     */
    private $dynamicBootp;

    /**
     * @var bool
     */
    private $abandoned;

    public function isAbandoned(): bool
    {
        return $this->abandoned;
    }

    public function setAbandoned(bool $abandoned): self
    {
        $this->abandoned = $abandoned;

        return $this;
    }

    public function isDynamicBootp(): bool
    {
        return $this->dynamicBootp;
    }

    public function setDynamicBootp(): self
    {
        $this->dynamicBootp = true;

        return $this;
    }

    public function getDdnsTxt(): string
    {
        return $this->ddnsTxt;
    }

    public function setDdnsTxt(string $ddnsTxt): self
    {
        $this->ddnsTxt = $ddnsTxt;

        return $this;
    }

    public function getDdnsRevName(): string
    {
        return $this->ddnsRevName;
    }

    public function setDdnsRevName(string $ddnsRevName): self
    {
        $this->ddnsRevName = $ddnsRevName;

        return $this;
    }

    public function getDdnsFwdName(): string
    {
        return $this->ddnsFwdName;
    }

    public function setDdnsFwdName(string $ddnsFwdName): self
    {
        $this->ddnsFwdName = $ddnsFwdName;

        return $this;
    }

    public function getVendorClassIdentifier(): string
    {
        return $this->vendorClassIdentifier;
    }

    public function setVendorClassIdentifier(string $vendorClassIdentifier): self
    {
        $this->vendorClassIdentifier = $vendorClassIdentifier;

        return $this;
    }

    public function getVendorClass(): string
    {
        return $this->vendorClass;
    }

    public function setVendorClass(string $vendorClass): self
    {
        $this->vendorClass = $vendorClass;

        return $this;
    }

    public function __construct($ip = null)
    {
        if (\is_string($ip)) {
            $this->setIp(new Ip($ip));
        }
        if ($ip instanceof Ip) {
            $this->setIp($ip);
        }
    }

    public function getIp(): ?Ip
    {
        return $this->ip;
    }

    public function setIp($ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getStarts(): ?\DateTime
    {
        return $this->starts;
    }

    public function setStarts(?\DateTime $starts): self
    {
        $this->starts = $starts;

        return $this;
    }

    public function getEnds(): ?\DateTime
    {
        return $this->ends;
    }

    public function setEnds(?\DateTime $ends): self
    {
        $this->ends = $ends;

        return $this;
    }

    public function getTstp(): ?\DateTime
    {
        return $this->tstp;
    }

    public function setTstp(?\DateTime $tstp): self
    {
        $this->tstp = $tstp;

        return $this;
    }

    public function getTsfp(): ?\DateTime
    {
        return $this->tsfp;
    }

    public function setTsfp(?\DateTime $tsfp): self
    {
        $this->tsfp = $tsfp;

        return $this;
    }

    public function getAtsfp(): ?\DateTime
    {
        return $this->atsfp;
    }

    public function setAtsfp(?\DateTime $atsfp): self
    {
        $this->atsfp = $atsfp;

        return $this;
    }

    public function getCltt(): ?\DateTime
    {
        return $this->cltt;
    }

    public function setCltt(?\DateTime $cltt): self
    {
        $this->cltt = $cltt;

        return $this;
    }

    public function getBindingState(): string
    {
        return $this->bindingState;
    }

    public function setBindingState(string $bindingState): self
    {
        $this->bindingState = $bindingState;

        return $this;
    }

    public function getNextBindingState(): string
    {
        return $this->nextBindingState;
    }

    public function setNextBindingState(string $nextBindingState): self
    {
        $this->nextBindingState = $nextBindingState;

        return $this;
    }

    public function getRewindBindingState(): string
    {
        return $this->rewindBindingState;
    }

    public function setRewindBindingState(string $rewindBindingState): self
    {
        $this->rewindBindingState = $rewindBindingState;

        return $this;
    }

    public function getHardware(): Hardware
    {
        return $this->hardware;
    }

    public function setHardware(Hardware $hardware)
    {
        $this->hardware = $hardware;

        return $this;
    }

    public function getClientHostname(): string
    {
        return $this->clientHostname;
    }

    public function setClientHostname(string $clientHostname): self
    {
        $this->clientHostname = $clientHostname;

        return $this;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }
}
