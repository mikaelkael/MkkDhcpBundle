<?php

namespace Mkk\DhcpBundle\Component\Parser;

use Hoa\Compiler\Llk\Llk;
use Hoa\Compiler\Llk\Parser;
use Hoa\File\Read;
use Hoa\Visitor\Visit;
use Mkk\DhcpBundle\Component\Host\HostFile;

abstract class AbstractParser
{
    /**
     * @return mixed
     * @throws FormatException
     */
    abstract public function parse(string $source);
}
