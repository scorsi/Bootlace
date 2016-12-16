<?php

namespace Bootlace\Http\Response;

trait ResponseContentTrait
{
    use ResponseLockTrait;

    private $content;

    /**
     * Clear the content.
     *
     * @return Response
     */
    public function clearContent(): Response
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content = '';
        return $this;
    }

    /**
     * Get the Response content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the Response content.
     *
     * @param string $content
     * @return Response
     */
    public function setContent(string $content = ""): Response
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content = $content;
        return $this;
    }

    /**
     * Prepends the content.
     *
     * @param string $content The string to prepend
     * @return Response
     */
    public function prependContent(string $content): Response
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content = $content . $this->content;
        return $this;
    }

    /**
     * Appends the content.
     *
     * @param string $content The string to append
     * @return Response
     */
    public function appendContent(string $content): Response
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content .= $content;
        return $this;
    }

    /**
     * Send our content.
     *
     * @return Response
     */
    public function sendContent(): Response
    {
        echo $this->content;
        $this->lock();
        return $this;
    }
}