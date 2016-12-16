<?php

namespace Bootlace\Http\Response\Cookie;

/**
 * Interface CookieManagerInterface
 *
 * @package Bootlace\Http
 */
interface CookieManagerInterface
{
    /**
     * Sends all cookies.
     *
     * @return void
     */
    public function send(): void;

    /**
     * Adds a new cookie.
     *
     * @param CookieInterface $cookie
     * @return CookieManagerInterface
     */
    public function addCookie(CookieInterface $cookie): CookieManagerInterface;

    /**
     * Deletes a cookie.
     *
     * @param string $cookieName
     * @return CookieManagerInterface
     */
    public function deleteCookie(string $cookieName): CookieManagerInterface;

    /**
     * Get all cookies.
     *
     * @return Cookie[]
     */
    public function getCookies(): array;

    /**
     * Get all cookies.
     *
     * @param string $cookieName
     * @return CookieInterface|null
     */
    public function getCookie(string $cookieName): ?CookieInterface;

    /**
     * Get the Cookie Builder.
     *
     * @return CookieBuilderInterface
     */
    public function getCookieBuilder(): CookieBuilderInterface;
}