<?php

namespace Bootlace\Exception;


class ControllerNotFoundException extends \RuntimeException implements ExceptionInterface
{
    public function __construct($name, $code = 0, \Exception $previous = null)
    {
        parent::__construct("Controller $name not found", $code, $previous);
    }
}