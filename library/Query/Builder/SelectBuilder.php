<?php

namespace Bootlace\Query\Builder;

use Bootlace\Query\Builder\Clause\WhereClauseBuilder;
use Bootlace\Query\Builder\Clause\WhereClause;
use InvalidArgumentException;

class SelectBuilder
{
    /* @var TableBuilder $tableBuilder */
    protected $tableBuilder;

    /* @var array $selectParam */
    protected $selectParam = array();

    /* @var WhereClauseBuilder $whereClauseBuilder */
    protected $whereClauseBuilder = null;

    /**
     * SelectBuilder constructor.
     * @param TableBuilder $tableBuilder
     */
    public function __construct(TableBuilder $tableBuilder)
    {
        $this->tableBuilder = $tableBuilder;
    }

    /**
     * @param string|array $selectParam
     * @return SelectBuilder
     */
    public function select($selectParam): SelectBuilder
    {
        if (is_string($selectParam))
            return $this->addSelectParam(array($selectParam));
        else if (is_array($selectParam))
            return $this->addSelectParam($selectParam);
        throw new InvalidArgumentException("Only string and array accepted.");
    }

    /**
     * Add Where Clause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return SelectBuilder
     */
    public function where(string $left, string $right, string $operator = '='): SelectBuilder
    {
        if ($this->whereClauseBuilder === null)
            $this->whereClauseBuilder = new WhereClauseBuilder($left, $right, $operator);
        return $this;
    }

    /**
     * Add Where Clause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return SelectBuilder
     */
    public function whereNot(string $left, string $right, string $operator = '='): SelectBuilder
    {
        if ($this->whereClauseBuilder === null)
            $this->whereClauseBuilder = new WhereClauseBuilder($left, $right, $operator, true);
        return $this;
    }

    /**
     * Add a AND Where Clause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return SelectBuilder
     */
    public function andWhere(string $left, string $right, string $operator = '='): SelectBuilder
    {
        if ($this->whereClauseBuilder != null)
            $this->whereClauseBuilder->andWhere($left, $right, $operator);
        else
            $this->where($left, $right, $operator);
        return $this;
    }

    /**
     * Add a OR Where Clause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return SelectBuilder
     */
    public function orWhere(string $left, string $right, string $operator = '='): SelectBuilder
    {
        if ($this->whereClauseBuilder != null)
            $this->whereClauseBuilder->orWhere($left, $right, $operator);
        else
            $this->where($left, $right, $operator);
        return $this;
    }

    /**
     * Add a AND Where Not Clause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return SelectBuilder
     */
    public function andWhereNot(string $left, string $right, string $operator = '='): SelectBuilder
    {
        if ($this->whereClauseBuilder != null)
            $this->whereClauseBuilder->andWhereNot($left, $right, $operator);
        else
            $this->whereNot($left, $right, $operator);
        return $this;
    }

    /**
     * Add a OR Where Not Clause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return SelectBuilder
     */
    public function orWhereNot(string $left, string $right, string $operator = '='): SelectBuilder
    {
        if ($this->whereClauseBuilder != null)
            $this->whereClauseBuilder->orWhereNot($left, $right, $operator);
        else
            $this->whereNot($left, $right, $operator);
        return $this;
    }

    /**
     * Render the Where Clauses
     * @return string
     */
    protected function renderWhere(): string
    {
        if ($this->whereClauseBuilder === null)
            return '';
        return ' WHERE ' . $this->whereClauseBuilder->render();
    }

    /**
     * Render the select params
     * @return string
     */
    protected function renderSelect(): string
    {
        if (empty($this->selectParam))
            return '*';
        $res = '';
        foreach ($this->selectParam as $select)
        {
            if (empty($res))
                $res = $select;
            else
                $res .= ', ' . $select;
        }
        return $res;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $dbh = $this->getTableBuilder()->getQueryBuilder()->getPDO();
        $tableName = $this->getTableBuilder()->getTable();

        $query = "SELECT " . $this->renderSelect() . " FROM $tableName" . $this->renderWhere();
        echo $query;

        $sth = $dbh->prepare($query);

        if ($this->whereClauseBuilder !== null)
            $this->whereClauseBuilder->bind($sth);
        $sth->execute();
        $res = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }

    /**
     * @param array $selectParam
     * @return SelectBuilder
     */
    protected function addSelectParam(array $selectParam): SelectBuilder
    {
        $this->selectParam = array_merge($this->selectParam, $selectParam);
        return $this;
    }

    /**
     * @return TableBuilder
     */
    public function getTableBuilder(): TableBuilder
    {
        return $this->tableBuilder;
    }
}