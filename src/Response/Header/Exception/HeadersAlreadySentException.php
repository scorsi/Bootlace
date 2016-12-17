<?php

namespace Bootlace\Response\Header\Exception;

use RuntimeException;
use Bootlace\Exception\ExceptionInterface;

/**
 * HeadersAlreadySentException
 *
 * Exception used for when a response is attempted to be sent after its already been sent
 */
class HeadersAlreadySentException extends RuntimeException implements ExceptionInterface
{
}
