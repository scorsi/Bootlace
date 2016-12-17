<?php

namespace Bootlace\Route\Exception;

use Bootlace\Exception\ExceptionInterface;
use LogicException;

class InvalidRouteFileException extends LogicException implements ExceptionInterface
{
    public function __construct($variableName, $code = 0, \Exception $previous = null)
    {
        $message = "Invalid route file: \"$variableName\" did not exists or is not readable or writable.";
        parent::__construct($message, $code, $previous);
    }
}
