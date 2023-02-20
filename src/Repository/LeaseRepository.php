<?php

namespace Mkk\DhcpBundle\Repository;

use Mkk\DhcpBundle\Component\Lease\Lease;
use Mkk\DhcpBundle\Component\Parser\FormatException;
use Mkk\DhcpBundle\Component\Parser\LeaseParser;

final class LeaseRepository extends AbstractFileRepository
{
    public function __construct(LeaseParser $parser, $leasesFileUri, $throwExceptionOnParseError)
    {
        parent::__construct($parser, $leasesFileUri, $throwExceptionOnParseError);
    }

    /**
     * @throws FormatException
     * @throws \InvalidArgumentException
     */
    public function getLeases(): array
    {
        return $this->readFile()->getLeases();
    }

    /**
     * @throws FormatException
     */
    public function getActiveFreeLeases(): array
    {
        return \array_filter($this->getLeases(), function (Lease $lease) {
            return 'active' === \strtolower($lease->getBindingState());
        });
    }
}
