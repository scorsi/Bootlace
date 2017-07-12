<?php

namespace Bootlace\Response\Header;

use Bootlace\DataCollection\DataCollection;
use Bootlace\DataCollection\DataCollectionInterface;
use Bootlace\Response\Header\HeaderNormalization\HeaderNormalization;
use Bootlace\Response\Header\HeaderNormalization\HeaderNormalizationInterface;

class HeaderDataCollection extends DataCollection implements HeaderNormalizationInterface
{
    /* @var int $normalization The actual normalization technique to use. */
    protected $normalization = self::NORMALIZE_ALL;

    /** @noinspection PhpMissingParentConstructorInspection Doesn't call our parent constructor. */
    /**
     * HeaderDataCollection constructor.
     *
     * @override (doesn't call our parent constructor)
     * @noinspection PhpMissingParentConstructorInspection
     * @param array $headers
     * @param int $normalization
     */
    public function __construct(array $headers = array(), int $normalization = self::NORMALIZE_ALL)
    {
        $this->normalization = $normalization;

        foreach ($headers as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Get the normalization parameter.
     * @return int
     */
    public function getNormalization(): int
    {
        return $this->normalization;
    }

    /**
     * Set the normalization parameter.
     *
     * @param int $normalization
     * @return HeaderDataCollection
     */
    public function setNormalization(int $normalization): HeaderDataCollection
    {
        $this->normalization = $normalization;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, $default = null)
    {
        $key = HeaderNormalization::normalizeKey($key, $this->normalization);

        return parent::get($key, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, $default = null, bool $override = true): DataCollectionInterface
    {
        $key = HeaderNormalization::normalizeKey($key, $this->normalization);

        return parent::set($key, $default, $override);
    }

    /**
     * {@inheritdoc}
     */
    public function isset(string $key): bool
    {
        $key = HeaderNormalization::normalizeKey($key, $this->normalization);

        return parent::exists($key);
    }

    /**
     * {@inheritdoc}
     */
    public function unset(string $key): DataCollectionInterface
    {
        $key = HeaderNormalization::normalizeKey($key, $this->normalization);

        return parent::remove($key);
    }
}