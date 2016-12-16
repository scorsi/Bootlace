<?php

namespace Bootlace\Http\Response;

use Bootlace\Exceptions\ResponseAlreadySentException;

/**
 * Interface ResponseInterface
 */
interface ResponseInterface
{
    /**
     * Set the header for redirecting to new location.
     *
     * @param string $url
     * @return ResponseInterface
     */
    public function redirect(string $url): ResponseInterface;

    /**
     * Tells the browser not to cache the response.
     *
     * @return ResponseInterface
     */
    public function noCache(): ResponseInterface;

    /**
     * Sends the response and lock it
     *
     * @param boolean $override Whether or not to override the check if the response has already been sent
     * @throws ResponseAlreadySentException If the response has already been sent
     * @return ResponseInterface
     */
    public function send($override = false): ResponseInterface;
}