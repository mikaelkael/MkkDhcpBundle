<?php

namespace Mkk\DhcpBundle\Component\Parser;

abstract class AbstractParser
{
    /**
     * @return mixed
     *
     * @throws FormatException
     */
    abstract public function parse(string $source);
}
