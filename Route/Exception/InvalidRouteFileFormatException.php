<?php

namespace Bootlace\Route\Exception;

use Bootlace\Exception\ExceptionInterface;
use LogicException;

class InvalidRouteFileFormatException extends LogicException implements ExceptionInterface
{
    public function __construct($variableName, $code = 0, \Exception $previous = null)
    {
        $message = "Invalid route file format: \"$variableName\" must contains a array. See the documentations. Please delete this file.";
        parent::__construct($message, $code, $previous);
    }
}
