<?php

namespace Mkk\DhcpBundle\Repository;

use Mkk\DhcpBundle\Component\Host\Host;
use Mkk\DhcpBundle\Component\Parser\FormatException;
use Mkk\DhcpBundle\Component\Parser\HostParser;

class HostRepository extends AbstractFileRepository
{

    public function __construct(HostParser $parser, $hostsFileUri)
    {
        parent::__construct($parser, $hostsFileUri);
    }

    /**
     * @return Host[]
     * @throws FormatException
     * @throws \InvalidArgumentException
     */
    public function getHosts()
    {
        return $this->readFile()->getHosts();
    }
}
