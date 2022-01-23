<?php

namespace Mkk\DhcpBundle\Repository;

use Mkk\DhcpBundle\Component\Parser\AbstractParser;
use Mkk\DhcpBundle\Component\Parser\FormatException;

class AbstractFileRepository
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

    public function __construct(AbstractParser $parser, string $fileUri)
    {
        $this->parser = $parser;
        $this->setFileUri($fileUri);
    }

    public function setFileUri(string $fileUri): AbstractFileRepository
    {
        $this->parsedContent = null;
        $this->fileUri = $fileUri;
        return $this;
    }

    /**
     * @throws FormatException
     * @throws \InvalidArgumentException
     */
    public function readFile(): mixed
    {
        if ($this->parsedContent === null) {
            if (substr($this->fileUri, 0, 7) != 'file://') {
                throw new \InvalidArgumentException(sprintf("can't read file '%s'", $this->fileUri));
            }
            if (!file_exists($this->fileUri)) {
                throw new \InvalidArgumentException(sprintf("file does not exist '%s'", $this->fileUri));
            }
            $content = file_get_contents($this->fileUri);
            if ($content === false) {
                throw new \InvalidArgumentException(sprintf("can't read file '%s'", $this->fileUri));
            }
            $this->parsedContent = $this->parser->parse($content);
        }
        return $this->parsedContent;
    }
}
