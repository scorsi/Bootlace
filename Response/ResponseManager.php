<?php

namespace Bootlace\Response;

use Bootlace\Response\Cookie\CookieDataCollection;
use Bootlace\Response\Cookie\CookieManager;
use Bootlace\Response\Header\HeaderDataCollection;
use Bootlace\Response\Header\HeaderManager;
use Bootlace\Response\Status\StatusManager;
use Bootlace\Response\Exception\ResponseAlreadySentException;
use Bootlace\Response\Header\Exception\HeadersAlreadySentException;

/**
 * Class ResponseManager
 *
 * @package Bootlace\Http
 */
class ResponseManager implements ResponseManagerInterface, ResponseContentInterface
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

    /**
     * Sets the HeaderDataCollection.
     *
     * @param HeaderDataCollection $headerDataCollection
     */
    public function setHeaderDataCollection(HeaderDataCollection $headerDataCollection)
    {
        $this->_headerDataCollection = $headerDataCollection;
    }

    /**
     * Sets the CookieDataCollection.
     *
     * @param CookieDataCollection $cookieDataCollection
     */
    public function setCookieDataCollection(CookieDataCollection $cookieDataCollection)
    {
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
     * @return ResponseManagerInterface
     */
    private function markAsSent(): ResponseManagerInterface
    {
        $this->sent = true;
        return $this;
    }

    /**
     * Sets the header for redirecting to new location.
     *
     * @param string $url
     * @return ResponseManagerInterface
     */
    public function redirect(string $url): ResponseManagerInterface
    {
        $this->getHeaderManager()->getHeadersDataCollection()->set('Location', $url);
        $this->getStatusManager()->setStatus(301); // Moved permanently
        return $this;
    }

    /**
     * Tells the browser not to cache the response.
     *
     * @return ResponseManagerInterface
     */
    public function noCache(): ResponseManagerInterface
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
     * @return ResponseManager
     */
    public function sendHeaders(bool $override = false): ResponseManager
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
     * @return ResponseManagerInterface
     */
    public function send($override = false): ResponseManagerInterface
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