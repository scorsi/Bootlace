<?php

namespace Bootlace\Renderer\Exception;

use Bootlace\Exception\ExceptionInterface;

/**
 * Basic TemplateEngine exception.
 */
class Exception extends \RuntimeException implements ExceptionInterface
{
    /**
     * Path of template file with error.
     */
    protected $templateFile = '';

    /**
     * Handles path of template file with error.
     *
     * @param string | null $templateFile
     * @return Exception | string
     */
    public function templateFile($templateFile)
    {
        if (is_null($templateFile))
            return $this->templateFile;

        $this->templateFile = (string)$templateFile;
        return $this;
    }
}