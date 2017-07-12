<?php

namespace Bootlace\Response\Cookie;

/**
 * Class CookieManager
 *
 * @package Bootlace\Http
 */
class CookieManager implements CookieManagerInterface
{
    /* @var string[] $_deletedCookies */
    protected $_deletedCookies = array();

    /* @var CookieDataCollection $_cookies */
    protected $_cookies = array();

    /* @var CookieBuilderInterface $_cookieBuilder */
    protected $_cookieBuilder = null;

    /**
     * CookieManager constructor.
     *
     * @param CookieDataCollection $cookieDataCollection
     */
    public function __construct(CookieDataCollection $cookieDataCollection)
    {
        $this->_cookies = $cookieDataCollection;
    }

    /**
     * Sends all cookies.
     *
     * @return void
     */
    public function send(): void
    {
        /* @var Cookie $cookie */
        foreach ($this->getCookies()->all() as $cookie) {
            setcookie(
                $cookie->getName(),
                $cookie->getValue(),
                $cookie->getMaxAge(),
                $cookie->getPath(),
                $cookie->getDomain(),
                $cookie->getSecure(),
                $cookie->getHttpOnly()
            );
        }
        return;
    }

    /**
     * Gets CookieDataCollection.
     *
     * @return CookieDataCollection
     */
    public function getCookies(): CookieDataCollection
    {
        return $this->_cookies;
    }

    /**
     * Gets the Cookie Builder.
     *
     * @return CookieBuilderInterface
     */
    public function getCookieBuilder(): CookieBuilderInterface
    {
        if (is_null($this->_cookieBuilder)) {
            $this->_cookieBuilder = new CookieBuilder();
        }
        return $this->_cookieBuilder;
    }
}