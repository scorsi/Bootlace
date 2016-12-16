<?php

namespace Bootlace\Http\Response;

interface ResponseContentInterface
{
    /**
     * Clear the content.
     *
     * @return Response
     */
    public function clearContent(): Response;

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
     * @return Response
     */
    public function setContent(string $content = ""): Response;

    /**
     * Prepends the content.
     *
     * @param string $content The string to prepend
     * @return Response
     */
    public function prependContent(string $content): Response;

    /**
     * Appends the content.
     *
     * @param string $content The string to append
     * @return Response
     */
    public function appendContent(string $content): Response;
}