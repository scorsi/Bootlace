<?php

namespace Bootlace\Response\Exception;

use RuntimeException;
use Bootlace\Exception\ExceptionInterface;

/**
 * ResponseAlreadySentException
 *
 * Exception used for when a response is attempted to be sent after its already been sent
 */
class ResponseAlreadySentException extends RuntimeException implements ExceptionInterface
{
}
