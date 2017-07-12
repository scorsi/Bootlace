<?php

namespace Bootlace\Response;

interface ResponseContentInterface
{
    /**
     * Clear the content.
     *
     * @return ResponseManager
     */
    public function clearContent(): ResponseManager;

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
     * @return ResponseManager
     */
    public function setContent(string $content = ""): ResponseManager;

    /**
     * Prepends the content.
     *
     * @param string $content The string to prepend
     * @return ResponseManager
     */
    public function prependContent(string $content): ResponseManager;

    /**
     * Appends the content.
     *
     * @param string $content The string to append
     * @return ResponseManager
     */
    public function appendContent(string $content): ResponseManager;
}