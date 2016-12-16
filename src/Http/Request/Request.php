<?php

namespace Bootlace\Http\Request;

use Bootlace\DataCollection\DataCollection;
use Bootlace\Http\Response\Header\HeaderDataCollection;
use Bootlace\Http\Response\Header\ServerDataCollection;
use Bootlace\Http\Response\Cookie\CookieDataCollection;
use Bootlace\Http\Request\Exception\MissingRequestMetaVariableException;

/**
 * Class Request
 *
 * @package Bootlace\Http
 */
class Request implements RequestInterface
{
    /* @var DataCollection $params_post : POST parameters */
    protected $params_post = null;

    /* @var DataCollection $params_get : GET parameters */
    protected $params_get = null;

    /* @var DataCollection $params_named : Named parameters */
    protected $params_named = null;

    /* @var CookieDataCollection $params_cookies : Client cookie data */
    protected $params_cookies = null;

    /* @var ServerDataCollection $params_server : Server created attributes */
    protected $params_server = null;

    /* @var HeaderDataCollection $params_headers : HTTP request headers */
    protected $params_headers = null;

    /* @var DataCollection $params_files : Uploaded temporary files */
    protected $params_files = null;

    /* @var string $params_body : The request body */
    protected $params_body = '';

    /* @var array $post_initial : Initial $params_post for Lazy Initialize */
    private $post_initial = array();

    /* @var array $get_initial : Initial $params_get for Lazy Initialize */
    private $get_initial = array();

    /* @var array $cookies_initial : Initial $cookies for Lazy Initialize */
    private $cookies_initial = array();

    /* @var array $server_initial : Initial $server for Lazy Initialize */
    private $server_initial = array();

    /* @var array $files_initial : Initial $files for Lazy Initialize */
    private $files_initial = array();

    /**
     * Request constructor.
     *
     * @param array $get
     * @param array $post
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param string $body
     */
    public function __construct(
        array $get = array(),
        array $post = array(),
        array $cookies = array(),
        array $files = array(),
        array $server = array(),
        string $body = '')
    {
        $this->get_initial = $get;
        $this->post_initial = $post;
        $this->cookies_initial = $cookies;
        $this->files_initial = $files;
        $this->server_initial = $server;
        $this->params_body = $body;
    }

    /**
     * Create a new request object using the built-in "superglobals"
     *
     * @link http://php.net/manual/en/language.variables.superglobals.php
     * @return RequestInterface
     */
    public function createFromGlobals(): RequestInterface
    {
        $this->get_initial = $_GET;
        $this->post_initial = $_POST;
        $this->cookies_initial = $_COOKIE;
        $this->files_initial = $_FILES;
        $this->server_initial = $_SERVER;
        return $this;
    }

    /**
     * Lazy initialize of paramsGet DataCollection.
     *
     * @return DataCollection
     */
    public function getParamsGet(): DataCollection
    {
        if (is_null($this->params_get)) {
            $this->params_get = new DataCollection($this->get_initial);
        }
        return $this->params_get;
    }

    /**
     * Lazy initialize of paramsPost DataCollection.
     *
     * @return DataCollection
     */
    public function getParamsPost(): DataCollection
    {
        if (is_null($this->params_post)) {
            $this->params_post = new DataCollection($this->post_initial);
        }
        return $this->params_post;
    }

    /**
     * Lazy initialize of paramsNamed DataCollection.
     *
     * @return DataCollection
     */
    public function getParamsNamed(): DataCollection
    {
        if (is_null($this->params_named)) {
            $this->params_named = new DataCollection();
        }
        return $this->params_named;
    }

    /**
     * Lazy initialize of cookies DataCollection.
     *
     * @return CookieDataCollection
     */
    public function getCookies(): CookieDataCollection
    {
        if (is_null($this->params_cookies)) {
            $this->params_cookies = new CookieDataCollection($this->cookies_initial);
        }
        return $this->params_cookies;
    }

    /**
     * Lazy initialize of server ServerDataCollection.
     *
     * @return ServerDataCollection
     */
    public function getServer(): ServerDataCollection
    {
        if (is_null($this->params_server)) {
            $this->params_server = new ServerDataCollection($this->server_initial);
        }
        return $this->params_server;
    }

    /**
     * Lazy initialize of headers DataCollection.
     *
     * @return HeaderDataCollection
     */
    public function getHeaders(): HeaderDataCollection
    {
        if (is_null($this->params_headers)) {
            $this->params_headers = new HeaderDataCollection($this->getServer()->getHeaders());
        }
        return $this->params_headers;
    }

    /**
     * Lazy initialize of files DataCollection.
     *
     * @return DataCollection
     */
    public function getFiles(): DataCollection
    {
        if (is_null($this->params_files)) {
            $this->params_files = new DataCollection($this->files_initial);
        }
        return $this->params_files;
    }

    /**
     * Gets the request body.
     *
     * @return string
     */
    public function getBody(): string
    {
        if (is_null($this->params_body)) {
            $this->params_body = @file_get_contents('php://input');
        }
        return $this->params_body;
    }

    /**
     * Checks if the request is secure.
     *
     * @throws MissingRequestMetaVariableException
     * @return boolean
     */
    public function isSecure(): bool
    {
        if (!$this->getServer()->exists('HTTPS')) {
            throw new MissingRequestMetaVariableException('HTTPS');
        }
        return ($this->getServer()->get('HTTPS') == true);
    }

    /**
     * Gets the request IP address.
     *
     * @throws MissingRequestMetaVariableException
     * @return null|string
     */
    public function ip(): ?string
    {
        if (!$this->getServer()->exists('REMOTE_ADDR')) {
            throw new MissingRequestMetaVariableException('REMOTE_ADDR');
        }
        return $this->getServer()->get('REMOTE_ADDR');
    }

    /**
     * Gets the http accept.
     *
     * @throws MissingRequestMetaVariableException
     * @return null|string
     */
    public function httpAccept(): ?string
    {
        if (!$this->getServer()->exists('HTTP_ACCEPT')) {
            throw new MissingRequestMetaVariableException('HTTP_ACCEPT');
        }
        return $this->getServer()->get('HTTP_ACCEPT');
    }

    /**
     * Gets the http referer.
     *
     * @throws MissingRequestMetaVariableException
     * @return null|string
     */
    public function referer(): ?string
    {
        if (!$this->getServer()->exists('HTTP_REFERER')) {
            throw new MissingRequestMetaVariableException('HTTP_REFERER');
        }
        return $this->getServer()->get('HTTP_REFERER');
    }

    /**
     * Gets the request user agent.
     *
     * @throws MissingRequestMetaVariableException
     * @return null|string
     */
    public function userAgent(): ?string
    {
        if (!$this->getServer()->exists('USER_AGENT')) {
            throw new MissingRequestMetaVariableException('USER_AGENT');
        }
        return $this->getHeaders()->get('USER_AGENT');
    }

    /**
     * Gets the request URI
     *
     * @throws MissingRequestMetaVariableException
     * @return null|string
     */
    public function uri(): ?string
    {
        if (!$this->getServer()->exists('REQUEST_URI')) {
            throw new MissingRequestMetaVariableException('REQUEST_URI');
        }
        return $this->getServer()->get('REQUEST_URI', '/');
    }

    /**
     * Get the request's pathname
     *
     * @return null|string
     */
    public function pathname(): ?string
    {
        $uri = $this->uri();
        if (is_null($uri)) {
            return null;
        }
        $uri = strstr($uri, '?', true) ?: $uri; // Strip the query string (GET params) from the URI
        return $uri;
    }

    /**
     * Gets the request method, or checks it against $is.
     *
     * <code>
     * // POST request example
     * $request->method() // returns 'POST'
     * $request->method('post') // returns true
     * $request->method('get') // returns false
     * </code>
     *
     * @param string $is The method to check the current request method against
     * @param boolean $allow_override Whether or not to allow HTTP method overriding via header or params
     * @return null|string
     */
    public function method(?string $is = null, bool $allow_override = true): ?string
    {
        $method = $this->getServer()->get('REQUEST_METHOD', 'GET');
        // Override
        if ($allow_override && $method === 'POST') {
            // For legacy servers, override the HTTP method with the X-HTTP-Method-Override header or _method parameter
            if ($this->getServer()->exists('X_HTTP_METHOD_OVERRIDE')) {
                $method = $this->getServer()->get('X_HTTP_METHOD_OVERRIDE', $method);
            } else {
                $method = ''; // TODO: FAIL OVER
            }
            $method = strtoupper($method);
        }
        if (is_null($is)) {
            return $method;
        }
        return strcasecmp($method, $is) === 0;
    }

    /**
     * Adds to or modifies the current query string.
     *
     * @param string $key The name of the query param
     * @param mixed $value The value of the query param
     * @return null|string
     */
    public function query(string $key, ?mixed $value = null): ?string
    {
        $query = array();
        parse_str(
            $this->getServer()->get('QUERY_STRING', ''),
            $query
        );
        if (is_array($key)) {
            $query = array_merge($query, $key);
        } else {
            $query[$key] = $value;
        }
        $request_uri = $this->uri();
        if (strpos($request_uri, '?') !== false) {
            $request_uri = strstr($request_uri, '?', true);
        }
        return $request_uri . (!empty($query) ? '?' . http_build_query($query) : null);
    }
}