<?php

namespace Bootlace\Query\Builder\Clause;

use InvalidArgumentException;
use PDOStatement;

class WhereClause
{
    static $AVAILABLE_OPERATOR = array(
        '=',
        '<>',
        '>',
        '<',
        '>=',
        '<=',
        'BETWEEN',
        'LIKE',
        'NOT LIKE',
        'IN'
    );

    static $ALIASES_OPERATOR = array(
        '==' => '=',
        '!=' => '<>',
        'between' => 'BETWEEN',
        'like' => 'LIKE',
        'not like' => 'NOT LIKE',
        'in' => 'IN'
    );

    /* @var string $right */
    protected $right;

    /* @var string $left */
    protected $left;

    /* @var string $operator */
    protected $operator;

    /**
     * WhereClause constructor.
     * @param string $left
     * @param string $right
     * @param string $operator
     */
    public function __construct(string $left, string $right, string $operator = '=')
    {
        if (!in_array($operator, self::$AVAILABLE_OPERATOR))
        {
            if (!in_array($operator, self::$ALIASES_OPERATOR))
                throw new InvalidArgumentException("Unknown where clause's $operator operator");
            $operator = self::$ALIASES_OPERATOR[$operator];
        }
        $this->left = $left;
        $this->right = $right;
        $this->operator = $operator;
    }

    /**
     * Generate the Where Clause Query
     * @return string
     */
    public function render(): string
    {
        return "$this->left $this->operator :$this->left";
    }

    /**
     * Bind Param into PDOStatement
     * @param PDOStatement $sth
     * @return PDOStatement
     */
    public function bind(PDOStatement $sth): PDOStatement
    {
        $sth->bindParam(":$this->left", $this->right);
        return $sth;
    }
}