<?php

namespace Bootlace\Http\Response\Header;

use Bootlace\DataCollection\DataCollection;

class ServerDataCollection extends DataCollection
{
    const HTTP_HEADER_PREFIX = 'HTTP_';

    const HTTP_NON_PREFIXED_HEADERS = array(
        'CONTENT_LENGTH',
        'CONTENT_TYPE',
        'CONTENT_MD5'
    );

    /**
     * Checks if the given string is prefixed by the given prefix.
     *
     * @param string $name
     * @param string $prefix
     * @return bool
     */
    public static function hasPrefix(string $name, string $prefix = self::HTTP_HEADER_PREFIX): bool
    {
        if (strpos($name, $prefix) === 0) {
            return true;
        }
        return false;
    }

    /**
     * Get our headers from our server data collection.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        $headers = array();
        foreach ($this->attributes as $key => $value) {
            if (self::hasPrefix($key, self::HTTP_HEADER_PREFIX)) {
                $headers[substr($key, strlen(self::HTTP_HEADER_PREFIX))] = $value;
            } elseif (in_array($key, self::HTTP_NON_PREFIXED_HEADERS)) {
                $headers[$key] = $value;
            }
        }
        return $headers;
    }

    /**
     * Alias for getHeaders().
     *
     * @return array
     */
    public function all(): array
    {
        return $this->attributes;
    }
}