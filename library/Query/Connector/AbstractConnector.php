<?php

namespace Bootlace\Query\Connector;

use PDO;

abstract class AbstractConnector implements ConnectorInterface
{
    /* @var PDO $pdo */
    protected $pdo;

    /* @var string $host */
    protected $host = 'localhost';

    /* @var int $port */
    protected $port = 5432;

    /* @var string $dbname */
    protected $dbname = 'dbname';

    /* @var string $user */
    protected $user = 'user';

    /* @var string $pass */
    protected $pass = 'pass';

    /**
     * AbstractConnector constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return ConnectorInterface
     */
    abstract public function constructPDO(): ConnectorInterface;

    /**
    * @return PDO
    */
    public function getPdo(): PDO
    {
        if ($this->pdo == null)
        {
            $this->constructPDO();
        }
        return $this->pdo;
    }

    /**
     * @param string $dbname
     * @return ConnectorInterface
     */
    public function setDbname(string $dbname): ConnectorInterface
    {
        $this->dbname = $dbname;
        return $this;
    }

    /**
     * @param string $user
     * @return ConnectorInterface
     */
    public function setUser(string $user): ConnectorInterface
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param string $pass
     * @return ConnectorInterface
     */
    public function setPass(string $pass): ConnectorInterface
    {
        $this->pass = $pass;
        return $this;
    }

    /**
     * @param mixed $host
     * @return ConnectorInterface
     */
    public function setHost(string $host): ConnectorInterface
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param mixed $port
     * @return ConnectorInterface
     */
    public function setPort(string $port): ConnectorInterface
    {
        $this->port = $port;
        return $this;
    }
}