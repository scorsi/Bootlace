<?php

namespace Bootlace\Query;

use Bootlace\Query\Connector\ConnectorInterface;
use Bootlace\Query\Exception\InvalidDatabaseConnectorException;
use Bootlace\Query\Builder\QueryBuilder;

class QueryManager
{
    /* @var ConnectorInterface $connector */
    protected $connector = null;

    public function __construct(?string $connector = null)
    {
        if ($connector !== null)
            $this->setConnector($connector);
    }

    /**
     * Create a new Query Builder
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        return new QueryBuilder($this->getConnector()->getPDO());
    }

    /**
     * @param string $connector
     * @return ConnectorInterface
     */
    public function setConnector(string $connector): ConnectorInterface
    {
        $filename = __DIR__ . '/Connector/' . $connector . 'Connector.php';
        if (file_exists($filename))
        {
            require_once $filename;
            $classname = 'Bootlace\\Query\\Connector\\' . $connector . 'Connector';
            $class = new $classname();
            $this->connector = $class;
            $this->connector->setDbname(DB_NAME)->setPass(DB_PASS)->setUser(DB_USER)->setHost(DB_HOST)->setPort(DB_PORT);
            return $this->connector;
        }
        throw new InvalidDatabaseConnectorException($connector);
    }

    /**
     * @return ConnectorInterface
     */
    public function getConnector(): ConnectorInterface
    {
        return $this->connector;
    }
}