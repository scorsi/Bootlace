<?php

namespace Bootlace\DataCollection;

interface DataCollectionInterface
{
    /**
     * Gets all attributes.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Gets one attribute corresponding to the key given.
     *
     * Default value is returns if not found.
     *
     * @param string $key
     * @param null|mixed $default
     * @return null|mixed
     */
    public function get(string $key, ?mixed $default = null): ?mixed;

    /**
     * Sets the attribute value corresponding to the key given.
     *
     * Optionally put false to override will not change the attribute if it exists.
     *
     * @param string $key
     * @param null|mixed $value
     * @param bool $override
     * @return DataCollectionInterface
     */
    public function set(string $key, ?mixed $value, bool $override = true): DataCollectionInterface;

    /**
     * Un sets the attribute corresponding to the key given.
     *
     * @param string $key
     * @return DataCollectionInterface
     */
    public function unset(string $key): DataCollectionInterface;

    /**
     * Alias for unset().
     *
     * @param string $key
     * @return DataCollectionInterface
     */
    public function remove(string $key): DataCollectionInterface;

    /**
     * Checks if the value corresponding to the ley given exists.
     *
     * @param string $key
     * @return bool
     */
    public function isset(string $key): bool;

    /**
     * Alias for isset().
     *
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool;

    /**
     * Merges the actual DataCollection attributes with new given.
     *
     * Optionally allows a second bool parameter to merge the attributes into the collection
     * in a "hard" mode, using the "array_replace" method instead of usual "array_merge" method.
     *
     * @param array $attributes
     * @param bool $hard
     * @return DataCollectionInterface
     */
    public function merge(array $attributes = array(), bool $hard = false): DataCollectionInterface;

    /**
     * Replaces the actual attributes with new one given.
     *
     * @param array $attributes
     * @return DataCollectionInterface
     */
    public function replace(array $attributes = array()): DataCollectionInterface;

    /**
     * Alias for replace() with empty param.
     *
     * @return DataCollectionInterface
     */
    public function clear(): DataCollectionInterface;
}