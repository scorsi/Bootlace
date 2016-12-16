<?php

namespace Bootlace\Http\Response;

interface ResponseContentInterface
{
    /**
     * Clear the content.
     *
     * @return ResponseContentTrait
     */
    public function clearContent(): ResponseContentTrait;

    /**
     * Get the Response content.
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Set the Response content.
     *
     * @param string $content
     * @return ResponseContentTrait
     */
    public function setContent(string $content = ""): ResponseContentTrait;

    /**
     * Prepends the content.
     *
     * @param string $content The string to prepend
     * @return ResponseContentTrait
     */
    public function prependContent(string $content): ResponseContentTrait;

    /**
     * Appends the content.
     *
     * @param string $content The string to append
     * @return ResponseContentTrait
     */
    public function appendContent(string $content): ResponseContentTrait;
}