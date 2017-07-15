<?php

namespace Bootlace\Query\Connector;

use PDO;

class PostgresConnector extends AbstractConnector
{
    public function constructPDO(): ConnectorInterface
    {
        $this->pdo = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->pass, array(
            PDO::ATTR_PERSISTENT => true
        ));
        return $this;
    }
}
