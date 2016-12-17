<?php

namespace Bootlace\Response\Cookie;

/**
 * Interface CookieBuilderInterface
 *
 * @package Bootlace\Http
 */
interface CookieBuilderInterface
{
    /**
     * Sets the default Cookie domain property.
     *
     * @param string $domain
     * @return CookieBuilderInterface
     */
    public function setDefaultDomain(string $domain): CookieBuilderInterface;

    /**
     * Sets the default Cookie path property.
     *
     * @param string $path
     * @return CookieBuilderInterface
     */
    public function setDefaultPath(string $path): CookieBuilderInterface;

    /**
     * Sets the default Cookie secure property.
     * @param bool $secure
     * @return CookieBuilderInterface
     */
    public function setDefaultSecure(bool $secure): CookieBuilderInterface;

    /**
     * Sets the default Cookie HttpOnly property.
     * @param bool $httpOnly
     * @return CookieBuilderInterface
     */
    public function setDefaultHttpOnly(bool $httpOnly): CookieBuilderInterface;

    /**
     * Build a new Cookie.
     *
     * @param string $name
     * @param string $value
     * @return CookieInterface
     */
    public function build(string $name, string $value): CookieInterface;
}