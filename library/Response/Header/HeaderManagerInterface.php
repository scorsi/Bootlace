<?php

namespace Bootlace\Response\Header;

/**
 * Interface HeaderManagerInterface
 *
 * @package Bootlace\Http
 */
interface HeaderManagerInterface
{
    /**
     * Sends headers.
     * @return void
     */
    public function send(): void;

    /**
     * Returns the HeaderDataCollection.
     *
     * @return HeaderDataCollection
     */
    public function getHeadersDataCollection(): HeaderDataCollection;
}