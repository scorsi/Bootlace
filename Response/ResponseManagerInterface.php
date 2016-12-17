<?php

namespace Bootlace\Response;

use Bootlace\Response\Exception\ResponseAlreadySentException;

/**
 * Interface ResponseManagerInterface
 */
interface ResponseManagerInterface
{
    /**
     * Set the header for redirecting to new location.
     *
     * @param string $url
     * @return ResponseManagerInterface
     */
    public function redirect(string $url): ResponseManagerInterface;

    /**
     * Tells the browser not to cache the response.
     *
     * @return ResponseManagerInterface
     */
    public function noCache(): ResponseManagerInterface;

    /**
     * Sends the response and lock it
     *
     * @param boolean $override Whether or not to override the check if the response has already been sent
     * @throws ResponseAlreadySentException If the response has already been sent
     * @return ResponseManagerInterface
     */
    public function send($override = false): ResponseManagerInterface;
}