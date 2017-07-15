<?php

namespace Bootlace\Query\Builder\Clause;

use InvalidArgumentException;

class WhereNotClause extends WhereClause
{
    static $AVAILABLE_OPERATOR = array(
        '=',
        '>',
        '<',
        '>=',
        '<=',
        'LIKE',
        'NOT LIKE'
    );

    static $ALIASES_OPERATOR = array(
        '==' => '=',
        '!=' => '<>',
        'like' => 'LIKE',
        'not like' => 'NOT LIKE',
    );

    static $NOT_OPERATOR = array(
        '=' => '<>',
        '>' => '<=',
        '<' => '>=',
        '>=' => '<',
        '<=' => '>',
        'LIKE' => 'NOT LIKE',
        'NOT LIKE' => 'LIKE'
    );

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
                throw new InvalidArgumentException("Unknown where not clause's $operator operator");
            $operator = self::$ALIASES_OPERATOR[$operator];
        }
        $operator = self::$NOT_OPERATOR[$operator];

        parent::__construct($left, $right, $operator);
    }
}