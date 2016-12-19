<?php

namespace Bootlace\Kernel;

use Bootlace\Request\RequestManager;
use Bootlace\Response\ResponseManager;
use Bootlace\Route\RouteManager;
use Bootlace\Route\Dispatcher\DispatcherInterface;

class Kernel
{
    /* @var RequestManager $_requestManager */
    protected $_requestManager;

    /* @var ResponseManager $_responseManager */
    protected $_responseManager;

    /* @var RouteManager $_routeManager */
    protected $_routeManager;

    /* @var string $base_dir */
    private $base_dir = '';

    /* @var bool $error */
    private $error = false;

    public function __construct(string $baseDir)
    {
        $this->base_dir = $baseDir;
        $this->_requestManager = new RequestManager();
        $this->_routeManager = new RouteManager();
        $this->_responseManager = new ResponseManager();

        $this->_construct();
    }

    public function getRequestManager()
    {
        return $this->_requestManager;
    }

    public function getResponseManager()
    {
        return $this->_responseManager;
    }

    public function getRouteManager()
    {
        return $this->_routeManager;
    }

    protected function _construct()
    {
        $this->getRequestManager()->createFromGlobals();

        $cookiesCollection = $this->getRequestManager()->getCookies();
        $this->getResponseManager()->setCookieDataCollection($cookiesCollection);
        $headersCollection = $this->getRequestManager()->getHeaders();
        $this->getResponseManager()->setHeaderDataCollection($headersCollection);

        $this->getRouteManager()->setRouteFile("$this->base_dir/app/routes.php")
            ->setCacheFile("$this->base_dir/cache/routes.php");
    }

    private function setError()
    {
        $this->error = true;
    }

    public function execute(): Kernel
    {
        return $this->dispatch()
            ->handle()
            ->send();
    }

    public function dispatch(): Kernel
    {
        $method = $this->getRequestManager()->method();
        $path = $this->getRequestManager()->pathname();
        $dispatchResult = $this->getRouteManager()->dispatch($method, $path);
        switch ($dispatchResult[0]) {
            case DispatcherInterface::NOT_FOUND:
                $this->getResponseManager()->setContent('404 - Page not found')
                    ->getStatusManager()->setStatus(404);
                $this->setError();
                break;
            case DispatcherInterface::METHOD_NOT_ALLOWED:
                $this->getResponseManager()->setContent('405 - Method not allowed')
                    ->getStatusManager()->setStatus(405);
                $this->setError();
                break;
            case DispatcherInterface::FOUND:
                var_dump($dispatchResult);
                break;
        }
        return $this;
    }

    public function handle(): Kernel
    {
        return $this;
    }

    public function send(): Kernel
    {
        $this->getResponseManager()->send();
        return $this;
    }
}