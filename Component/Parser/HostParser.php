<?php

namespace Mkk\DhcpBundle\Component\Parser;

use Hoa\Visitor\Visit;
use Mkk\DhcpBundle\Component\Host\HostFile;
use Mkk\DhcpBundle\Component\Parser\Visitor\Host\HostFileVisitor;

/**
 * @method HostFile parseStream($handle)
 * @method HostFile parseFile($handle)
 */
class HostParser extends AbstractParser
{
    /**
     * @var Visit
     */
    private $visitor;

    /**
     * @param string $source
     * @return HostFile
     * @throws FormatException
     */
    public function parse($source)
    {
        if ($source == '') {
            return new HostFile();
        } else {
            return parent::parse($source);
        }
    }

    protected function getGrammar()
    {
        return __DIR__ . '/../../Resources/grammar/isc-dhcp-server-min.pp';
    }

    protected function getVisitor()
    {
        if (is_null($this->visitor)) {
            $this->visitor = new HostFileVisitor();
        }
        return $this->visitor;
    }
}
