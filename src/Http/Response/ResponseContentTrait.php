<?php

namespace Bootlace\Http\Response;

trait ResponseContentTrait
{
    use ResponseLockTrait;

    private $content;

    /**
     * Clear the content.
     *
     * @return ResponseContentTrait
     */
    public function clearContent(): ResponseContentTrait
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
     * @return ResponseContentTrait
     */
    public function setContent(string $content = ""): ResponseContentTrait
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content = $content;
        return $this;
    }

    /**
     * Prepends the content.
     *
     * @param string $content The string to prepend
     * @return ResponseContentTrait
     */
    public function prependContent(string $content): ResponseContentTrait
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content = $content . $this->content;
        return $this;
    }

    /**
     * Appends the content.
     *
     * @param string $content The string to append
     * @return ResponseContentTrait
     */
    public function appendContent(string $content): ResponseContentTrait
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content .= $content;
        return $this;
    }

    /**
     * Send our content.
     *
     * @return ResponseContentTrait
     */
    public function sendContent(): ResponseContentTrait
    {
        echo $this->content;
        $this->lock();
        return $this;
    }
}