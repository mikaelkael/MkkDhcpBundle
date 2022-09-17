<?php

namespace Mkk\DhcpBundle\Component\Parser;

abstract class AbstractParser
{
    protected $throwExceptionOnParseError = true;

    /**
     * @return mixed
     *
     * @throws FormatException
     */
    abstract public function parse(string $source);

    public function setThrowExceptionOnParseError(bool $throwExceptionOnParseError): self
    {
        $this->throwExceptionOnParseError = $throwExceptionOnParseError;

        return $this;
    }
}
