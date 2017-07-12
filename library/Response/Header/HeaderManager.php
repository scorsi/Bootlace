<?php

namespace Bootlace\Response\Header;

/**
 * Class HeaderManager
 *
 * @package Bootlace\Http
 */
class HeaderManager implements HeaderManagerInterface
{
    /* @var HeaderDataCollection $_headers */
    protected $_headers = array();

    /**
     * HeaderManager constructor.
     *
     * @param HeaderDataCollection $headerDataCollection
     */
    public function __construct(HeaderDataCollection $headerDataCollection)
    {
        $this->_headers = $headerDataCollection;
    }

    /**
     * Returns the HeaderDataCollection.
     *
     * @return HeaderDataCollection
     */
    public function getHeadersDataCollection(): HeaderDataCollection
    {
        return $this->_headers;
    }

    /**
     * Sends headers.
     * @return void
     */
    public function send(): void
    {
        foreach ($this->getHeadersDataCollection()->all() as $key => $value) {
            header("$key: $value", false);
        }
    }
}