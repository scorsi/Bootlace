<?php

namespace Bootlace\Response\Cookie;

/**
 * Class Cookie
 *
 * @package Bootlace\Http
 */
class Cookie implements CookieInterface
{
    /* @var string $name */
    private $name;

    /* @var string $value */
    private $value;

    /* @var string $domain */
    private $domain;

    /* @var string $path */
    private $path;

    /* @var int $maxAge */
    private $maxAge;

    /* @var bool $secure */
    private $secure = false;

    /* @var string $httpOnly */
    private $httpOnly = false;

    /**
     * Cookie Constructor.
     *
     * @param string $name The name of the cookie
     * @param string $value The value to set the cookie with
     * @param int $maxAge The time that the cookie should expire
     * @param string $path The path of which to restrict the cookie
     * @param string $domain The domain of which to restrict the cookie
     * @param boolean $secure Flag of whether the cookie should only be sent over a HTTPS connection
     * @param boolean $http_only Flag of whether the cookie should only be accessible over the HTTP protocol
     */
    public function __construct(
        string $name,
        string $value = '',
        int $maxAge = 0,
        string $path = '',
        string $domain = '',
        bool $secure = false,
        bool $http_only = false)
    {
        $this->setName($name);
        $this->setValue($value);
        $this->setMaxAge($maxAge);
        $this->setPath($path);
        $this->setDomain($domain);
        $this->setSecure($secure);
        $this->setHttpOnly($http_only);
    }

    /**
     * Sets the cookie name.
     *
     * @param string $name
     * @return CookieInterface
     */
    public function setName(string $name): CookieInterface
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the cookie name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the cookie value.
     *
     * @param string $value
     * @return CookieInterface
     */
    public function setValue($value): CookieInterface
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets the cookie value.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets the cookie max age.
     *
     * @param int $seconds
     * @return CookieInterface
     */
    public function setMaxAge(int $seconds): CookieInterface
    {
        $this->maxAge = $seconds;
        return $this;
    }

    /**
     * Gets the cookie max age.
     *
     * @return int
     */
    public function getMaxAge(): int
    {
        return $this->maxAge;
    }

    /**
     * Sets the cookie domain.
     *
     * @param string $domain
     * @return CookieInterface
     */
    public function setDomain(string $domain): CookieInterface
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Gets the cookie Domain.
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Sets the cookie path.
     *
     * @param  string $path
     * @return CookieInterface
     */
    public function setPath(string $path): CookieInterface
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Gets the cookie path.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Sets the cookie secure.
     *
     * @param  boolean $secure
     * @return CookieInterface
     */
    public function setSecure(bool $secure): CookieInterface
    {
        $this->secure = $secure;
        return $this;
    }

    /**
     * Gets the cookie secure.
     *
     * @return bool
     */
    public function getSecure(): bool
    {
        return $this->secure;
    }

    /**
     * Sets the cookie http only.
     *
     * @param bool $httpOnly
     * @return CookieInterface
     */
    public function setHttpOnly(bool $httpOnly): CookieInterface
    {
        $this->httpOnly = $httpOnly;
        return $this;
    }

    /**
     * Gets the cookie http only.
     *
     * @return string
     */
    public function getHttpOnly(): string
    {
        return $this->httpOnly;
    }
}