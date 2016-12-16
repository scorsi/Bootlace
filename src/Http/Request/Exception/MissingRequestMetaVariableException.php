<?php

namespace Bootlace\Http\Request\Exception;

use RuntimeException;
use Bootlace\Exception\ExceptionInterface;

/**
 * Exception MissingRequestMetaVariableException
 *
 * @package Bootlace\Http
 */
class MissingRequestMetaVariableException extends RuntimeException implements ExceptionInterface
{
    public function __construct($variableName, $code = 0, \Exception $previous = null)
    {
        $message = "Request meta-variable $variableName was not set.";
        parent::__construct($message, $code, $previous);
    }
}