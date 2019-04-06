<?php

namespace Mkk\DhcpBundle\Component\Parser\Visitor\Host;

use Hoa\Compiler\Llk\TreeNode;
use Hoa\Visitor\Element;
use Hoa\Visitor\Visit;
use Mkk\DhcpBundle\Component\Host\Hardware;

class HardwareVisitor implements Visit
{
    public function visit(Element $element, &$handle = null, $eldnah = null)
    {
        if (!$element instanceof TreeNode || $element->getId() !== '#hardware') {
            throw new \InvalidArgumentException($element->getId());
        }

        return (new Hardware())
            ->setType($element->getChild(0)->getChild(0)->getValueValue())
            ->setAddress($element->getChild(1)->getChild(0)->getValueValue());
    }
}
