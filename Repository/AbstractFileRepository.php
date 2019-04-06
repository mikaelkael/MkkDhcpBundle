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

    public function __construct(AbstractParser $parser, $fileUri)
    {
        $this->parser = $parser;
        $this->setFileUri($fileUri);
    }

    /**
     * @param string $fileUri
     * @return AbstractFileRepository
     */
    public function setFileUri($fileUri)
    {
        $this->parsedContent = null;
        $this->fileUri = $fileUri;
        return $this;
    }

    /**
     * @return mixed
     * @throws FormatException
     * @throws \InvalidArgumentException
     */
    public function readFile()
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