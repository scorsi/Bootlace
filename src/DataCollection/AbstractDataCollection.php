<?php

namespace Bootlace\DataCollection;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use ArrayIterator;

abstract class AbstractDataCollection implements IteratorAggregate, ArrayAccess, Countable, DataCollectionInterface
{
    /* @var array $attribute */
    protected $attributes = array();

    /**
     * AbstractDataCollection constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        $this->attributes = $attributes;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function all(): array;

    /**
     * {@inheritdoc}
     */
    abstract public function get(string $key, ?mixed $default = null): ?mixed;

    /**
     * {@inheritdoc}
     */
    abstract public function set(string $key, ?mixed $value, bool $override = true): DataCollectionInterface;

    /**
     * {@inheritdoc}
     */
    abstract public function unset(string $key): DataCollectionInterface;

    /**
     * {@inheritdoc}
     */
    public function remove(string $key): DataCollectionInterface
    {
        return $this->unset($key);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function isset(string $key): bool;

    /**
     * {@inheritdoc}
     */
    public function exists(string $key): bool
    {
        return $this->isset($key);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function merge(array $attributes = array(), bool $hard = false): DataCollectionInterface;

    /**
     * {@inheritdoc}
     */
    abstract public function replace(array $attributes = array()): DataCollectionInterface;

    /**
     * {@inheritdoc}
     */
    public function clear(): DataCollectionInterface
    {
        return $this->replace(array());
    }

    /**
     * Alias for get().
     *
     * @param string $key
     * @return null|mixed
     */
    public function __get(string $key): ?mixed
    {
        return $this->get($key);
    }

    /**
     * Alias for set().
     *
     * @param string $key
     * @param null|mixed $value
     * @param bool $override
     * @return DataCollectionInterface
     */
    public function __set(string $key, ?mixed $value, bool $override = true): DataCollectionInterface
    {
        return $this->set($key, $value, $override);
    }

    /**
     * Alias for isset().
     *
     * @param string $key
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return $this->exists($key);
    }

    /**
     * Alias for unset().
     *
     * @param string $key
     * @return DataCollectionInterface
     */
    public function __unset(string $key): DataCollectionInterface
    {
        return $this->unset($key);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new ArrayIterator($this->attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($key, $value)
    {
        return $this->set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($key)
    {
        return $this->exists($key);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($key)
    {
        return $this->unset($key);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->attributes);
    }
}