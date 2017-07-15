<?php

namespace Bootlace\Query\Exception;

use Bootlace\Exception\ExceptionInterface;
use RuntimeException;

class InvalidTableException extends RuntimeException implements ExceptionInterface
{
    public function __construct($name, $code = 0, \Exception $previous = null)
    {
        parent::__construct("Invalid table $name: not found", $code, $previous);
    }
}