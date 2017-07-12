<?php

namespace Bootlace;

use Bootlace\Renderer\Renderer;
use Bootlace\Request\RequestManager;
use Bootlace\Response\ResponseManager;
use Bootlace\Route\RouteManager;
use Bootlace\Route\Dispatcher\DispatcherInterface;
use Bootlace\Exception\ControllerNotFoundException;

class Kernel
{
    /* @var RequestManager $_requestManager */
    protected $_requestManager;

    /* @var ResponseManager $_responseManager */
    protected $_responseManager;

    /* @var RouteManager $_routeManager */
    protected $_routeManager;

    /* @var Renderer $_renderer */
    protected $_renderer;

    /* @var string $baseDir */
    private $baseDir = '';

    /* @var string $base_dir */
    private $baseUrl = '';

    /* @var bool $error */
    private $error = false;

    /**
     * Kernel constructor.
     * @param string $baseDir
     * @param string $baseUrl
     */
    public function __construct(string $baseDir = __DIR__, string $baseUrl = '')
    {
        $this->baseDir = $baseDir;
        $this->baseUrl = $baseUrl;

        $this->_requestManager = new RequestManager();
        $this->_routeManager = new RouteManager();
        $this->_responseManager = new ResponseManager();
        $this->_renderer = new Renderer();
        $this->_renderer->objectConfigure(array('tpl_dir' => $this->baseDir . '/view/',
            'cache_dir' => $this->baseDir . '/cache/template/'));

        $this->_construct();
    }

    /**
     * @return RequestManager
     */
    public function getRequestManager()
    {
        return $this->_requestManager;
    }

    /**
     * @return ResponseManager
     */
    public function getResponseManager()
    {
        return $this->_responseManager;
    }

    /**
     * @return RouteManager
     */
    public function getRouteManager()
    {
        return $this->_routeManager;
    }

    /**
     * @return Renderer
     */
    public function getRenderer(): Renderer
    {
        return $this->_renderer;
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->getRequestManager()->createFromGlobals();

        $cookiesCollection = $this->getRequestManager()->getCookies();
        $this->getResponseManager()->setCookieDataCollection($cookiesCollection);
        $headersCollection = $this->getRequestManager()->getHeaders();
        $this->getResponseManager()->setHeaderDataCollection($headersCollection);

        $this->getRouteManager()
            ->setRouteFile("$this->baseDir/config/routes.php")
            ->setCacheFile("$this->baseDir/cache/routes.php")
            ->setBaseURL("$this->baseUrl");
    }

    /**
     *
     */
    private function setError()
    {
        $this->error = true;
    }

    /**
     * @return Kernel
     */
    public function execute(): Kernel
    {
        return $this->dispatch()
            ->handle()
            ->send();
    }

    /**
     * @throws ControllerNotFoundException
     * @return Kernel
     */
    public function dispatch(): Kernel
    {
        if ($this->error === true)
            return $this;

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
                $filename = __DIR__ . '/../app/' . $dispatchResult[1] . '.php';
                if (file_exists($filename))
                {
                    require_once $filename;
                    $classname = 'App\\' . $dispatchResult[1];
                    /* @var \Bootlace\Controller $class */
                    $class = new $classname($this->getRequestManager(), $this->getResponseManager(), $this->getRenderer());
                    $html = $class->run();
                }
                else
                    throw new ControllerNotFoundException($dispatchResult[1]);
                $this->getResponseManager()->setContent($html);
                break;
        }
        return $this;
    }

    /**
     * @return Kernel
     */
    public function handle(): Kernel
    {
        return $this;
    }

    /**
     * @return Kernel
     */
    public function send(): Kernel
    {
        $this->getResponseManager()->send();
        return $this;
    }
}