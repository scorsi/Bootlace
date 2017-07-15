<?php

namespace Bootlace\Query\Builder;

use PDO;

class QueryBuilder
{
    /* @var PDO $pdo */
    private $pdo;

    /**
     * QueryBuilder constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $table
     * @return TableBuilder
     */
    public function table(string $table): TableBuilder
    {
        return new TableBuilder($this, $table);
    }

    /**
     * @return PDO
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}