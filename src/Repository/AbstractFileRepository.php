<?php

namespace Mkk\DhcpBundle\Repository;

use Mkk\DhcpBundle\Component\Parser\AbstractParser;
use Mkk\DhcpBundle\Component\Parser\FormatException;

abstract class AbstractFileRepository
{
    /**
     * @var AbstractParser
     */
    private $parser;

    /**
     * @var string
     */
    private $fileUri;

    private $parsedContent = null;

    protected $throwExceptionOnParseError = true;

    public function __construct(AbstractParser $parser, string $fileUri, bool $throwExceptionOnParseError = true)
    {
        $this->parser = $parser;
        $this->setFileUri($fileUri);
        $this->throwExceptionOnParseError = $throwExceptionOnParseError;
    }

    public function setFileUri(string $fileUri): self
    {
        $this->parsedContent = null;
        $this->fileUri = $fileUri;

        return $this;
    }

    /**
     * @return mixed
     *
     * @throws FormatException
     * @throws \InvalidArgumentException
     */
    public function readFile()
    {
        if (null === $this->parsedContent) {
            if ('file://' != \substr($this->fileUri, 0, 7)) {
                throw new \InvalidArgumentException(\sprintf("can't read file '%s'", $this->fileUri));
            }
            if (!\file_exists($this->fileUri)) {
                throw new \InvalidArgumentException(\sprintf("file does not exist '%s'", $this->fileUri));
            }
            $content = \file_get_contents($this->fileUri);
            if (false === $content) {
                throw new \InvalidArgumentException(\sprintf("can't read file '%s'", $this->fileUri));
            }
            $this->parsedContent = $this->parser->setThrowExceptionOnParseError($this->throwExceptionOnParseError)->parse($content);
        }

        return $this->parsedContent;
    }
}
