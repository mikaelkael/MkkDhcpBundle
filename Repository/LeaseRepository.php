<?php

namespace Mkk\DhcpBundle\Repository;

use Mkk\DhcpBundle\Component\Lease\Lease;
use Mkk\DhcpBundle\Component\Parser\FormatException;
use Mkk\DhcpBundle\Component\Parser\LeaseParser;

class LeaseRepository extends AbstractFileRepository
{

    public function __construct(LeaseParser $parser, $leasesFileUri)
    {
        parent::__construct($parser, $leasesFileUri);
    }

    /**
     * @return mixed
     * @throws FormatException
     * @throws \InvalidArgumentException
     */
    public function getLeases()
    {
        return $this->readFile()->getLeases();
    }

    /**
     * @return array
     * @throws FormatException
     */
    public function getActiveFreeLeases()
    {
        return array_filter($this->getLeases(), function (Lease $lease) {
            return strtolower($lease->getBindingState()) === 'active';
        });
    }
}
