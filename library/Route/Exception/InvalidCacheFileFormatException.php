<?php

namespace Bootlace\Route\Exception;

use Bootlace\Exception\ExceptionInterface;
use LogicException;

class InvalidCacheFileFormatException extends LogicException implements ExceptionInterface
{
    public function __construct($variableName, $code = 0, \Exception $previous = null)
    {
        $message = "Invalid cache file format: \"$variableName\" must contains a array. See the documentations. Please delete this file.";
        parent::__construct($message, $code, $previous);
    }
}
