<?php

namespace Bootlace\Renderer\Exception;

use Bootlace\Exception\ExceptionInterface;

class TemplateNotFoundException extends \RuntimeException implements ExceptionInterface
{
    public function __construct($name, $code = 0, \Exception $previous = null)
    {
        parent::__construct("Template $name not found", $code, $previous);
    }
}
