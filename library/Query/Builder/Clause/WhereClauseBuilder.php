<?php

namespace Bootlace\Query\Builder\Clause;

use PDOStatement;

class WhereClauseBuilder
{
    /* @var WhereClause $firstClause */
    private $firstClause;

    /* @var array $clauses */
    private $clauses = array();

    /* @var array $operators */
    private $operators = array();

    /**
     * WhereClauseManager constructor.
     * @param string $left
     * @param string $right
     * @param string $operator
     * @param bool $not
     */
    public function __construct(string $left, string $right, string $operator, bool $not = false)
    {
        if ($not === false)
            $this->firstClause = new WhereClause($left, $right, $operator);
        else
            $this->firstClause = new WhereNotClause($left, $right, $operator);
    }

    /**
     * Add a AND WhereClause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return WhereClauseBuilder
     */
    public function andWhere(string $left, string $right, string $operator): WhereClauseBuilder
    {
        $this->clauses[] = new WhereClause($left, $right, $operator);
        $this->operators[] = 'AND';
        return $this;
    }

    /**
     * Add a OR WhereClause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return WhereClauseBuilder
     */
    public function orWhere(string $left, string $right, string $operator): WhereClauseBuilder
    {
        $this->clauses[] = new WhereClause($left, $right, $operator);
        $this->operators[] = 'OR';
        return $this;
    }

    /**
     * Add a AND WhereNotClause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return WhereClauseBuilder
     */
    public function andWhereNot(string $left, string $right, string $operator): WhereClauseBuilder
    {
        $this->clauses[] = new WhereNotClause($left, $right, $operator);
        $this->operators[] = 'AND';
        return $this;
    }

    /**
     * Add a OR WhereNotClause
     * @param string $left
     * @param string $right
     * @param string $operator
     * @return WhereClauseBuilder
     */
    public function orWhereNot(string $left, string $right, string $operator): WhereClauseBuilder
    {
        $this->clauses[] = new WhereNotClause($left, $right, $operator);
        $this->operators[] = 'OR';
        return $this;
    }

    /**
     * Render all Where Clause
     * @return string
     */
    public function render(): string
    {
        $res = $this->firstClause->render();
        /* @var WhereClause $clause */
        foreach ($this->clauses as $id => $clause)
        {
            $res .= ' ' . $this->operators[$id] . ' ' . $clause->render();
        }
        return $res;
    }

    /**
     * Bind all Where Clause param
     * @param PDOStatement $sth
     * @return PDOStatement
     */
    public function bind(PDOStatement $sth): PDOStatement
    {
        $this->firstClause->bind($sth);
        /* @var WhereClause $clause */
        foreach ($this->clauses as $clause)
        {
            $clause->bind($sth);
        }
        return $sth;
    }
}