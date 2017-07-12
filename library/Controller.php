<?php

namespace Bootlace;

use Bootlace\Renderer\Renderer;
use Bootlace\Response\ResponseManager;
use Bootlace\Request\RequestManager;

class Controller implements ControllerInterface
{
    /* @var RequestManager $_requestManager */
    private $_requestManager;

    /* @var ResponseManager $_responseManager */
    private $_responseManager;

    /* @var Renderer $_renderer */
    private $_renderer;

    public function __construct(RequestManager $requestManager, ResponseManager $responseManager, Renderer $renderer)
    {
        $this->_requestManager = $requestManager;
        $this->_responseManager = $responseManager;
        $this->_renderer = $renderer;
    }

    /**
     * @param string $templateName
     * @return string
     */
    protected function render(string $templateName): string
    {
        return $this->getRenderer()->draw($templateName, true);
    }

    /**
     * @return ResponseManager
     */
    public function getResponseManager(): ResponseManager
    {
        return $this->_responseManager;
    }

    /**
     * @return RequestManager
     */
    public function getRequestManager(): RequestManager
    {
        return $this->_requestManager;
    }

    /**
     * @return Renderer
     */
    public function getRenderer(): Renderer
    {
        return $this->_renderer;
    }

    public function run(): string {}
}