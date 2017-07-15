<?php

namespace Bootlace\Query\Connector;

use PDO;

class MysqlConnector extends AbstractConnector
{
    public function constructPDO(): ConnectorInterface
    {
        $this->pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->pass, array(
            PDO::ATTR_PERSISTENT => true
        ));
        return $this;
    }
}