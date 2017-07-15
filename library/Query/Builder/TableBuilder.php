<?php

namespace Bootlace\Query\Builder;

use Bootlace\Query\Exception\InvalidTableException;

class TableBuilder
{
    /* @var QueryBuilder $queryBuilder */
    protected $queryBuilder;

    /* @var string $table */
    protected $table;

    /**
     * TableBuilder constructor.
     * @param QueryBuilder $queryBuilder
     * @param string $table
     */
    public function __construct(QueryBuilder $queryBuilder, string $table)
    {
        $this->queryBuilder = $queryBuilder;
        if ($this->checkTable($table))
            $this->table = $table;
        else
            throw new InvalidTableException($table);
    }

    /**
     * Check if the given table exists or not.
     * @param string $tableName
     * @return bool
     */
    protected function checkTable(string $tableName): bool
    {
        $dbh = $this->getQueryBuilder()->getPDO();
        $sth = $dbh->prepare("SELECT count(*) AS nb_table FROM information_schema.tables WHERE table_name = :tableName");
        $sth->bindParam(':tableName', $tableName);
        $sth->execute();
        $res = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if (intval($res[0]['nb_table']) >= 1)
            return true;
        return false;
    }

    /**
     * Create a SelectBuilder
     * @param array|string|null $select
     * @return SelectBuilder
     */
    public function select($select = null): SelectBuilder
    {
        $selectBuilder = new SelectBuilder($this);
        if ($select == null)
            $select = '*';
        return $selectBuilder->select($select);
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }
}