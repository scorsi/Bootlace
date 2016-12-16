<?php

namespace Bootlace\Http\Request;

/**
 * Interface RequestInterface
 *
 * @package Bootlace\Http
 */
interface RequestInterface
{
    /**
     * Returns a parameter value from POST or GET parameters or a default value if none is set.
     *
     * @param string $key
     * @param string|null $defaultValue (optional)
     * @return string|null
     */
    public function getParameter(string $key, ?string $defaultValue = null): ?string;

    /**
     * Returns GET and POST parameters.
     *
     * @return array
     */
    public function getParameters(): array;

    /**
     * Returns a parameter value from GET parameters or a default value if none is set.
     *
     * @param string $key
     * @param string|null $defaultValue (optional)
     * @return string|null
     */
    public function getGetParameter(string $key, ?string $defaultValue = null): ?string;

    /**
     * Returns all GET parameters.
     *
     * @return array
     */
    public function getGetParameters(): array;

    /**
     * Returns a parameter value from POST parameters or a default value if none is set.
     *
     * @param string $key
     * @param string|null $defaultValue (optional)
     * @return string|null
     */
    public function getPostParameter(string $key, ?string $defaultValue = null): ?string;

    /**
     * Returns all POST parameters.
     *
     * @return array
     */
    public function getPostParameters(): array;

    /**
     * Returns a file value or a default value if none is set.
     *
     * @param string $key
     * @param string|null $defaultValue (optional)
     * @return string|null
     */
    public function getFile(string $key, ?string $defaultValue = null): ?string;

    /**
     * Returns all files.
     *
     * @return array
     */
    public function getFiles(): array;

    /**
     * Returns a cookie value or a default value if none is set.
     *
     * @param string $key
     * @param string|null $defaultValue (optional)
     * @return string|null
     */
    public function getCookie(string $key, ?string $defaultValue = null): ?string;

    /**
     * Returns all cookies.
     *
     * @return array
     */
    public function getCookies(): array;

    /**
     * Returns raw values from the read-only stream that allows you to read raw data from the request body.
     *
     * @return string
     */
    public function getRawBody(): string;

    /**
     * The URI which was given in order to access this page
     *
     * @return string
     * @throws MissingRequestMetaVariableException
     */
    public function getUri(): string;

    /**
     * Return just the path
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * Which request method was used to access the page;
     * i.e. 'GET', 'HEAD', 'POST', 'PUT'.
     *
     * @return string
     * @throws MissingRequestMetaVariableException
     */
    public function getMethod(): string;

    /**
     * Contents of the Accept: header from the current request, if there is one.
     *
     * @return string
     * @throws MissingRequestMetaVariableException
     */
    public function getHttpAccept(): string;

    /**
     * The address of the page (if any) which referred the user agent to the
     * current page.
     *
     * @return string
     * @throws MissingRequestMetaVariableException
     */
    public function getReferer(): string;

    /**
     * Content of the User-Agent header from the request, if there is one.
     *
     * @return string
     * @throws MissingRequestMetaVariableException
     */
    public function getUserAgent(): string;

    /**
     * The IP address from which the user is viewing the current page.
     *
     * @return string
     * @throws MissingRequestMetaVariableException
     */
    public function getIpAddress(): string;

    /**
     * Checks to see whether the current request is using HTTPS.
     *
     * @return bool
     */
    public function isSecure(): bool;

    /**
     * The query string, if any, via which the page was accessed.
     *
     * @return string
     * @throws MissingRequestMetaVariableException
     */
    public function getQueryString(): string;
}