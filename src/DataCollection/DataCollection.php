<?php

namespace Bootlace\DataCollection;

class DataCollection extends AbstractDataCollection
{
    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, ?mixed $default = null): ?mixed
    {
        if ($this->isset($key)) {
            return $this->attributes[$key];
        } else {
            return $default;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, ?mixed $value, bool $override = true): DataCollectionInterface
    {
        if ($override || $this->isset($key)) {
            $this->attributes[$key] = $value;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function unset(string $key): DataCollectionInterface
    {
        if (!empty($this->attributes[$key])) {
            unset($this->attributes[$key]);
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isset(string $key): bool
    {
        return array_key_exists($key, $this->attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function replace(array $attributes = array()): DataCollectionInterface
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(array $attributes = array(), bool $hard = false): DataCollectionInterface
    {
        if (!empty($attributes)) {
            if ($hard) {
                $this->attributes = array_replace(
                    $this->attributes,
                    $attributes
                );
            } else {
                $this->attributes = array_merge(
                    $this->attributes,
                    $attributes
                );
            }
        }
        return $this;
    }

    /**
     * Checks if there are attributes.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->attributes);
    }

    /**
     * A quick convenience method to get an empty clone of the collection.
     * Can be great for Dependency Injection.
     *
     * @return DataCollection
     */
    public function cloneEmpty(): DataCollection
    {
        $clone = clone $this;
        $clone->clear();

        return $clone;
    }
}