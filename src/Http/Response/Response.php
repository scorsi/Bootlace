<?php

namespace Bootlace\Http\Response;

use Bootlace\Http\Response\Cookie\CookieDataCollection;
use Bootlace\Http\Response\Cookie\CookieManager;
use Bootlace\Http\Response\Header\HeaderDataCollection;
use Bootlace\Http\Response\Header\HeaderManager;
use Bootlace\Http\Response\Status\StatusManager;
use Bootlace\Http\Response\Exception\ResponseAlreadySentException;
use Bootlace\Http\Response\Header\Exception\HeadersAlreadySentException;

/**
 * Class Response
 *
 * @package Bootlace\Http
 */
class Response implements ResponseInterface, ResponseContentInterface
{
    use ResponseContentTrait;

    /* @var StatusManager $_statusManager */
    protected $_statusManager = null;

    /* @var HeaderManager $_headerManager */
    protected $_headerManager = null;

    /* @var HeaderDataCollection $_headerDataCollection Singleton for $_headerManager */
    private $_headerDataCollection = null;

    /* @var CookieManager $_cookieManager */
    protected $_cookieManager = null;

    /* @var CookieDataCollection $_cookieDataCollection Singleton for $_cookieManager */
    private $_cookieDataCollection = null;

    /* @var bool $sent Is the content already sent? */
    private $sent = false;

    public function __construct(
        HeaderDataCollection $headerDataCollection,
        CookieDataCollection $cookieDataCollection)
    {
        $this->_headerDataCollection = $headerDataCollection;
        $this->_cookieDataCollection = $cookieDataCollection;
    }

    /**
     * Lazy initialize of Status $_statusManager.
     *
     * @return StatusManager
     */
    public function getStatusManager(): StatusManager
    {
        if (is_null($this->_statusManager)) {
            $this->_statusManager = new StatusManager();
        }
        return $this->_statusManager;
    }

    /**
     * Lazy initialize of HeaderDataCollection $_headerManager.
     *
     * @return HeaderManager
     */
    public function getHeaderManager(): HeaderManager
    {
        if (is_null($this->_headerManager)) {
            $this->_headerManager = new HeaderManager($this->_headerDataCollection);
        }
        return $this->_headerManager;
    }

    /**
     * Lazy initialize of CookieDataCollection $_cookieManager.
     *
     * @return CookieManager
     */
    public function getCookieManager(): CookieManager
    {
        if (is_null($this->_cookieManager)) {
            $this->_cookieManager = new CookieManager($this->_cookieDataCollection);
        }
        return $this->_cookieManager;
    }

    /**
     * Marks the response as sent.
     *
     * @return ResponseInterface
     */
    private function markAsSent(): ResponseInterface
    {
        $this->sent = true;
        return $this;
    }

    /**
     * Sets the header for redirecting to new location.
     *
     * @param string $url
     * @return ResponseInterface
     */
    public function redirect(string $url): ResponseInterface
    {
        $this->getHeaderManager()->getHeadersDataCollection()->set('Location', $url);
        $this->getStatusManager()->setStatus(301); // Moved permanently
        return $this;
    }

    /**
     * Tells the browser not to cache the response.
     *
     * @return ResponseInterface
     */
    public function noCache(): ResponseInterface
    {
        $this->getHeaderManager()->getHeadersDataCollection()->set('Pragma', 'no-cache');
        $this->getHeaderManager()->getHeadersDataCollection()->set('Cache-Control', 'no-store, no-cache');
        return $this;
    }

    /**
     * Sends our HTTP headers.
     *
     * @param boolean $override Whether or not to override the check if headers have already been sent
     * @throws HeadersAlreadySentException
     * @return Response
     */
    public function sendHeaders(bool $override = false): Response
    {
        if (headers_sent() && !$override) {
            throw new HeadersAlreadySentException('Headers were already been sent');
        }

        $this->getStatusManager()->send();

        if (!is_null($this->_headerManager)) { // Do not render is there was any modifications.
            $this->getHeaderManager()->send();
        }
        if (!is_null($this->_cookieManager)) { // Do not render is there was any modifications.
            $this->getCookieManager()->send();
        }
        return $this;
    }

    /**
     * Sends the response and lock it
     *
     * @param boolean $override Whether or not to override the check if the response has already been sent
     * @throws ResponseAlreadySentException If the response has already been sent
     * @return ResponseInterface
     */
    public function send($override = false): ResponseInterface
    {
        if ($this->sent && !$override) {
            throw new ResponseAlreadySentException('Response has already been sent');
        }
        $this->sendHeaders($override);
        $this->sendContent();
        $this->markAsSent();
        // If there running FPM, tell the process manager to finish the server request/response handling
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }
        return $this;
    }
}