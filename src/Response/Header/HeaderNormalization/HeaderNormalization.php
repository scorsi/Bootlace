<?php

namespace Bootlace\Response\Header\HeaderNormalization;

class HeaderNormalization implements HeaderNormalizationInterface
{
    /**
     * Normalize the header key base on our set normalization style.
     *
     * @param string $key
     * @param int $normalization
     * @return string
     */
    public static function normalizeKey(string $key, int $normalization): string
    {
        if ($normalization & static::NORMALIZE_TRIM) {
            $key = static::normalizeKeyTrim($key);
        }
        if ($normalization & static::NORMALIZE_DELIMITERS) {
            $key = static::normalizeKeyDelimiters($key);
        }
        if ($normalization & static::NORMALIZE_CASE) {
            $key = static::normalizeKeyCase($key);
        }
        if ($normalization & static::NORMALIZE_CANONICAL) {
            $key = static::normalizeKeyCanonical($key);
        }
        return $key;
    }

    /**
     * Normalize a header key's whitespace.
     *
     * @param string $key
     * @return string
     */
    public static function normalizeKeyTrim(string $key): string
    {
        return trim($key);
    }

    /**
     * Normalize a header key's delimiters.
     *
     * This will convert any space or underscore characters to a
     * more standard hyphen character.
     *
     * @param string $key
     * @return string
     */
    public static function normalizeKeyDelimiters(string $key): string
    {
        return str_replace(array(' ', '_'), '-', $key);
    }

    /**
     * Normalize a header key.
     *
     * This will lowercase all character.
     *
     * @param string $key
     * @return string
     */
    public static function normalizeKeyCase(string $key): string
    {
        return strtolower($key);
    }

    /**
     * Canonicalize a header key.
     *
     * The canonical format is all lower case except for the first letter
     * of each "words" separated by a hyphen.
     *
     * @param string $key
     * @return string
     */
    public static function normalizeKeyCanonical(string $key): string
    {
        $words = explode('-', strtolower($key));

        foreach ($words as &$word) {
            $word = ucfirst($word);
        }

        return implode('-', $words);
    }
}