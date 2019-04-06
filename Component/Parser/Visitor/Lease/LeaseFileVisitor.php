<?php

namespace Mkk\DhcpBundle\Component\Parser\Visitor\Lease;

use Hoa\Compiler\Llk\TreeNode;
use Hoa\Visitor\Element;
use Hoa\Visitor\Visit;
use Mkk\DhcpBundle\Component\Lease\LeaseFile;
use Mkk\DhcpBundle\Component\Parser\Visitor\Lease\LeaseVisitor;

class LeaseFileVisitor implements Visit
{
    /**
     * @var Visit
     */
    private $leaseVisitor;

    /**
     * LeaseFileVisitor constructor.
     */
    public function __construct()
    {
        $this->leaseVisitor = new LeaseVisitor();
    }

    public function visit(Element $element, &$handle = null, $eldnah = null)
    {
        if (!$element instanceof TreeNode || $element->getId() !== '#leaseFile') {
            throw new \InvalidArgumentException($element->getId());
        }
        $leaseFile = new LeaseFile();

        foreach ($element->getChildren() as $child) {
            /* @var TreeNode $child */
            switch ($child->getId()) {
                case '#lease':
                    $lease = $child->accept($this->leaseVisitor, $handle, $eldnah);
                    $leaseFile->addLease($lease);
                    break;
                case '#failOverPeer':
                    // TODO implement
                    break;
                case '#serverDuid':
                    // TODO implement
                    break;
                case '#authoringByteOrder':
                    // TODO implement
                    break;
                default:
                    throw new \InvalidArgumentException($child->getId());
            }
        }

        return $leaseFile;
    }
}
