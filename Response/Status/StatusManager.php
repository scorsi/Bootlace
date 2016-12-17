<?php

namespace Bootlace\Response\Status;

/**
 * Class StatusManager
 *
 * @package Bootlace\Http
 */
class StatusManager implements StatusManagerInterface
{
    /* @var string $_statusText */
    protected $statusText = "OK";

    /* @var int $_statusCode */
    protected $statusCode = 200;

    /* @var string $protocolVersion */
    protected $protocolVersion = '1.1';

    /**
     * StatusManager constructor.
     *
     * @param null|int $statusCode
     * @param null|string $statusText
     */
    public function __construct(?int $statusCode = null, ?string $statusText = null)
    {
        if ($statusCode != null) {
            $this->setStatus($statusCode, $statusText);
        }
    }

    /**
     * Sends Status.
     */
    public function send(): void
    {
        $this->httpStatusLine();
    }

    /**
     * Set the StatusLine Header.
     */
    public function httpStatusLine(): void
    {
        header(sprintf('HTTP/%s %s %s',
            trim($this->protocolVersion),
            trim($this->statusCode),
            trim($this->statusText)));
    }

    /**
     * Set the protocol version (HTTP Version).
     *
     * @param string $protocolVersion
     * @return StatusManagerInterface
     */
    public function setProtocolVersion(string $protocolVersion): StatusManagerInterface
    {
        $this->protocolVersion = $protocolVersion;
        return $this;
    }

    /**
     * Sets the HTTP status.
     *
     * @param int $statusCode
     * @param null|string $statusText (optional)
     * @return StatusManagerInterface
     */
    public function setStatus(int $statusCode, ?string $statusText = null): StatusManagerInterface
    {
        if ($statusText === null && array_key_exists($statusCode, self::STATUS_TEXTS)) {
            $statusText = self::STATUS_TEXTS[$statusCode];
        }
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
        return $this;
    }

    /**
     * Returns the HTTP status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Returns the HTTP status text.
     *
     * @return string
     */
    public function getStatusText(): string
    {
        return $this->statusText;
    }
}