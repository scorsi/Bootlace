<?php

namespace Bootlace\Http\Response\Cookie;

use Bootlace\DataCollection\DataCollection;
use Bootlace\DataCollection\DataCollectionInterface;

class CookieDataCollection extends DataCollection
{
    /** @noinspection PhpMissingParentConstructorInspection */
    /**
     * CookieDataCollection constructor.
     *
     * @param array $cookies
     */
    public function __construct(array $cookies = array())
    {
        foreach ($cookies as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Set a cookie.
     *
     * A value may either
     *
     * @param string $key
     * @param null|mixed $value
     * @param bool $override
     * @return DataCollectionInterface
     */
    public function set(string $key, ?mixed $value, bool $override = true): DataCollectionInterface
    {
        if (!$value instanceof Cookie) {
            $value = new Cookie($key, $value);
        }
        return parent::set($key, $value, $override);
    }
}