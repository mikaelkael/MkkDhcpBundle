<?php

namespace Mkk\DhcpBundle\Component\Parser;

use Hoa\Visitor\Visit;
use Mkk\DhcpBundle\Component\Parser\Visitor\Lease\LeaseFileVisitor;

class LeaseParser extends AbstractParser
{
    /**
     * @var Visit
     */
    private $visitor;

    public function __construct()
    {
        parent::__construct();
        $this->visitor = new LeaseFileVisitor();
    }

    protected function getGrammar()
    {
        return __DIR__ . '/../../Resources/grammar/leases.pp';
    }

    protected function getVisitor()
    {
        return $this->visitor;
    }
}
