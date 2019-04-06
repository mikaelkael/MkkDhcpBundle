<?php

namespace Mkk\DhcpBundle\Component\Parser\Visitor\Host;

use Hoa\Compiler\Llk\TreeNode;
use Hoa\Visitor\Element;
use Hoa\Visitor\Visit;
use Mkk\DhcpBundle\Component\Host\HostFile;

class HostFileVisitor implements Visit
{
    /**
     * @var Visit
     */
    private $hostVisitor;

    public function __construct()
    {
        $this->hostVisitor = new HostVisitor();
    }

    /**
     * @param Element $element
     * @param null $handle
     * @param null $eldnah
     * @return HostFile
     */
    public function visit(Element $element, &$handle = null, $eldnah = null)
    {
        if (!$element instanceof TreeNode || $element->getId() !== '#config') {
            throw new \InvalidArgumentException($element->getId());
        }
        $config = new HostFile();

        foreach ($element->getChildren() as $child) {
            /* @var TreeNode $child */
            switch ($child->getId()) {
                case '#host':
                    $host = $child->accept($this->hostVisitor, $handle, $eldnah);
                    $config->addHost($host);
                    break;
                default:
                    throw new \InvalidArgumentException($child->getId());
            }
        }

        return $config;
    }
}
