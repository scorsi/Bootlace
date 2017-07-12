<?php

namespace Bootlace\Response;

trait ResponseContentTrait
{
    use ResponseLockTrait;

    private $content;

    /**
     * Clear the content.
     *
     * @return ResponseManager|ResponseContentTrait
     */
    public function clearContent(): ResponseManager
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
     * @return ResponseManager|ResponseContentTrait
     */
    public function setContent(string $content = ""): ResponseManager
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content = $content;
        return $this;
    }

    /**
     * Prepends the content.
     *
     * @param string $content The string to prepend
     * @return ResponseManager|ResponseContentTrait
     */
    public function prependContent(string $content): ResponseManager
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content = $content . $this->content;
        return $this;
    }

    /**
     * Appends the content.
     *
     * @param string $content The string to append
     * @return ResponseManager|ResponseContentTrait
     */
    public function appendContent(string $content): ResponseManager
    {
        $this->requireUnlocked(); // Require that the response be unlocked before changing it.
        $this->content .= $content;
        return $this;
    }

    /**
     * Send our content.
     *
     * @return ResponseManager|ResponseContentTrait
     */
    public function sendContent(): ResponseManager
    {
        echo $this->content;
        $this->lock();
        return $this;
    }
}