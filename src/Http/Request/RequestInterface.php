<?php

namespace Bootlace\Http\Request;

use Bootlace\DataCollection\DataCollection;
use Bootlace\Http\Response\Cookie\CookieDataCollection;
use Bootlace\Http\Response\Header\HeaderDataCollection;
use Bootlace\Http\Response\Header\ServerDataCollection;
use Bootlace\Http\Request\Exception\MissingRequestMetaVariableException;

/**
 * Interface RequestInterface
 *
 * @package Bootlace\Http
 */
interface RequestInterface
{
    /**
     * Create a new request object using the built-in "superglobals"
     *
     * @link http://php.net/manual/en/language.variables.superglobals.php
     * @return RequestInterface
     */
    public function createFromGlobals(): RequestInterface;

    /**
     * Lazy initialize of paramsGet DataCollection.
     *
     * @return DataCollection
     */
    public function getParamsGet(): DataCollection;

    /**
     * Lazy initialize of paramsPost DataCollection.
     *
     * @return DataCollection
     */
    public function getParamsPost(): DataCollection;

    /**
     * Lazy initialize of paramsNamed DataCollection.
     *
     * @return DataCollection
     */
    public function getParamsNamed(): DataCollection;

    /**
     * Lazy initialize of cookies DataCollection.
     *
     * @return CookieDataCollection
     */
    public function getCookies(): CookieDataCollection;

    /**
     * Lazy initialize of server ServerDataCollection.
     *
     * @return ServerDataCollection
     */
    public function getServer(): ServerDataCollection;

    /**
     * Lazy initialize of headers DataCollection.
     *
     * @return HeaderDataCollection
     */
    public function getHeaders(): HeaderDataCollection;

    /**
     * Lazy initialize of files DataCollection.
     *
     * @return DataCollection
     */
    public function getFiles(): DataCollection;

    /**
     * Gets the request body.
     *
     * @return string
     */
    public function getBody(): string;

    /**
     * Checks if the request is secure.
     *
     * @throws MissingRequestMetaVariableException
     * @return boolean
     */
    public function isSecure(): bool;

    /**
     * Gets the request IP address.
     *
     * @throws MissingRequestMetaVariableException
     * @return mixed
     */
    public function ip(): mixed;

    /**
     * Gets the http accept.
     *
     * @throws MissingRequestMetaVariableException
     * @return mixed
     */
    public function httpAccept(): mixed;

    /**
     * Gets the http referer.
     *
     * @throws MissingRequestMetaVariableException
     * @return mixed
     */
    public function referer(): mixed;

    /**
     * Gets the request user agent.
     *
     * @throws MissingRequestMetaVariableException
     * @return mixed
     */
    public function userAgent(): mixed;

    /**
     * Gets the request URI
     *
     * @throws MissingRequestMetaVariableException
     * @return mixed
     */
    public function uri(): mixed;

    /**
     * Get the request's pathname
     *
     * @return mixed
     */
    public function pathname(): mixed;

    /**
     * Gets the request method, or checks it against $is.
     *
     * <code>
     * // POST request example
     * $request->method() // returns 'POST'
     * $request->method('post') // returns true
     * $request->method('get') // returns false
     * </code>
     *
     * @param string $is The method to check the current request method against
     * @param boolean $allow_override Whether or not to allow HTTP method overriding via header or params
     * @return mixed
     */
    public function method(?string $is = null, bool $allow_override = true): mixed;

    /**
     * Adds to or modifies the current query string.
     *
     * @param string $key The name of the query param
     * @param mixed $value The value of the query param
     * @return string
     */
    public function query(string $key, ?mixed $value = null): string;
}