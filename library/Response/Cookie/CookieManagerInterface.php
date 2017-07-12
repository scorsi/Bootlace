<?php

namespace Bootlace\Response\Cookie;

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
     * Get all cookies.
     *
     * @return CookieDataCollection
     */
    public function getCookies(): CookieDataCollection;

    /**
     * Get the Cookie Builder.
     *
     * @return CookieBuilderInterface
     */
    public function getCookieBuilder(): CookieBuilderInterface;
}