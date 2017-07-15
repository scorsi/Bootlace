<?php

namespace Bootlace\Query\Connector;

use PDO;

interface ConnectorInterface
{
    public function constructPdo(): ConnectorInterface;

    public function getPdo(): PDO;

    public function setHost(string $host): ConnectorInterface;

    public function setDbname(string $dbname): ConnectorInterface;

    public function setUser(string $user): ConnectorInterface;

    public function setPass(string $pass): ConnectorInterface;

    public function setPort(string $port): ConnectorInterface;
}