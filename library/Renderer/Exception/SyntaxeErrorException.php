<?php

namespace Src\TemplateEngine;

use Bootlace\Exception\ExceptionInterface;

/**
 * Exception thrown when syntax error occurs.
 */
class SyntaxeErrorException extends \RuntimeException implements ExceptionInterface
{
    /**
     * Line in template file where error has occured.
     *
     * @var int | null
     */
    protected $templateLine = null;

    /**
     * Tag which caused an error.
     *
     * @var string | null
     */
    protected $tag = null;

    /**
     * Handles the line in template file
     * where error has occured
     *
     * @param int | null $line
     *
     * @return SyntaxeErrorException | int | null
     */
    public function templateLine($line)
    {
        if (is_null($line))
            return $this->templateLine;

        $this->templateLine = (int)$line;
        return $this;
    }

    /**
     * Handles the tag which caused an error.
     *
     * @param string | null $tag
     *
     * @return SyntaxeErrorException | string | null
     */
    public function tag($tag = null)
    {
        if (is_null($tag))
            return $this->tag;

        $this->tag = (string)$tag;
        return $this;
    }
}