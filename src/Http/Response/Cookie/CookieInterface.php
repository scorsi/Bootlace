<?php

namespace Bootlace\Http\Response\Cookie;

/**
 * Interface CookieInterface
 *
 * @package Bootlace\Http
 */
interface CookieInterface
{
    /**
     * Sets the cookie name.
     *
     * @param string $name
     * @return CookieInterface
     */
    public function setName(string $name): CookieInterface;

    /**
     * Gets the cookie name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Sets the cookie value.
     *
     * @param string $value
     * @return CookieInterface
     */
    public function setValue($value): CookieInterface;

    /**
     * Gets the cookie value.
     *
     * @return string
     */
    public function getValue(): string;

    /**
     * Sets the cookie max age.
     *
     * @param int $seconds
     * @return CookieInterface
     */
    public function setMaxAge(int $seconds): CookieInterface;

    /**
     * Gets the cookie max age.
     *
     * @return int
     */
    public function getMaxAge(): int;

    /**
     * Sets the cookie domain.
     *
     * @param string $domain
     * @return CookieInterface
     */
    public function setDomain(string $domain): CookieInterface;

    /**
     * Gets the cookie Domain.
     *
     * @return string
     */
    public function getDomain(): string;

    /**
     * Sets the cookie path.
     *
     * @param  string $path
     * @return CookieInterface
     */
    public function setPath(string $path): CookieInterface;

    /**
     * Gets the cookie path.
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * Sets the cookie secure.
     *
     * @param  boolean $secure
     * @return CookieInterface
     */
    public function setSecure(bool $secure): CookieInterface;

    /**
     * Gets the cookie secure.
     *
     * @return bool
     */
    public function getSecure(): bool;

    /**
     * Sets the cookie http only.
     *
     * @param bool $httpOnly
     * @return CookieInterface
     */
    public function setHttpOnly(bool $httpOnly): CookieInterface;

    /**
     * Gets the cookie http only.
     *
     * @return string
     */
    public function getHttpOnly(): string;
}