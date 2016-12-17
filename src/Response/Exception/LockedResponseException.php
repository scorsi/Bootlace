<?php

namespace Bootlace\Response\Exception;

use RuntimeException;
use Bootlace\Exception\ExceptionInterface;

/**
 * LockedResponseException
 *
 * Exception used for when a response is attempted to be modified while its locked
 */
class LockedResponseException extends RuntimeException implements ExceptionInterface
{
}
