<?php

namespace Bootlace;

use Bootlace\Query\Builder\QueryBuilder;
use Bootlace\Query\QueryManager;
use Bootlace\Renderer\Renderer;
use Bootlace\Response\ResponseManager;
use Bootlace\Request\RequestManager;

class Controller implements ControllerInterface
{
    /* @var RequestManager $requestManager */
    private $requestManager;

    /* @var ResponseManager $responseManager */
    private $responseManager;

    /* @var Renderer $renderer */
    private $renderer;

    /* @var QueryManager $queryManager */
    private $queryManager;

    /**
     * Controller constructor.
     * @param RequestManager $requestManager
     * @param ResponseManager $responseManager
     * @param Renderer $renderer
     * @param QueryManager $queryManager
     */
    public function __construct(RequestManager $requestManager, ResponseManager $responseManager, Renderer $renderer, QueryManager $queryManager)
    {
        $this->requestManager = $requestManager;
        $this->responseManager = $responseManager;
        $this->renderer = $renderer;
        $this->queryManager = $queryManager;
    }

    /**
     * @return string
     */
    public function handle(): string
    {
        return '';
    }

    /**
     * @param string $templateName
     * @return string
     */
    protected function render(string $templateName): string
    {
        return $this->getRenderer()->draw($templateName, true);
    }

    protected function assign($variable, $value = null)
    {
        return $this->getRenderer()->assign($variable, $value);
    }

    /**
     * @return QueryBuilder
     */
    protected function query()
    {
        return $this->queryManager->query();
    }

    /**
     * @return ResponseManager
     */
    public function getResponseManager(): ResponseManager
    {
        return $this->responseManager;
    }

    /**
     * @return RequestManager
     */
    public function getRequestManager(): RequestManager
    {
        return $this->requestManager;
    }

    /**
     * @return Renderer
     */
    public function getRenderer(): Renderer
    {
        return $this->renderer;
    }

    /**
     * @return QueryManager
     */
    public function getQueryManager(): QueryManager
    {
        return $this->queryManager;
    }
}