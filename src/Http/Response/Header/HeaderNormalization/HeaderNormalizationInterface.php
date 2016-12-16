<?php

namespace Bootlace\Http\Response\Header\HeaderNormalization;

interface HeaderNormalizationInterface
{
    /**
     * Don't normalize.
     * @type int
     */
    const NORMALIZE_NONE = 0;

    /**
     * Normalize the outer whitespace of the header.
     * @type int
     */
    const NORMALIZE_TRIM = 1;

    /**
     * Normalize the delimiters of the header.
     * @type int
     */
    const NORMALIZE_DELIMITERS = 2;

    /**
     * Normalize the case of the header.
     * @type int
     */
    const NORMALIZE_CASE = 4;

    /**
     * Normalize the header into canonical format.
     * @type int
     */
    const NORMALIZE_CANONICAL = 8;

    /**
     * Normalize using all normalization techniques.
     * @type int
     */
    const NORMALIZE_ALL = -1;
}