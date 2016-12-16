<?php

namespace Bootlace\Http\Response;

use Bootlace\Http\Response\Exception\LockedResponseException;

trait ResponseLockTrait
{
    private $locked;

    /**
     * Check if the response is locked.
     *
     * @return boolean
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * Require that the response is unlocked.
     *
     * Throws an exception if the response is locked,
     * preventing any methods from mutating the response
     * when its locked.
     *
     * @throws LockedResponseException  If the response is locked
     */
    public function requireUnlocked(): void
    {
        if ($this->isLocked()) {
            throw new LockedResponseException('Response is locked');
        }
    }

    /**
     * Lock the response from further modification.
     */
    public function lock(): void
    {
        $this->locked = true;
    }

    /**
     * Unlock the response from further modification.
     */
    public function unlock(): void
    {
        $this->locked = false;
    }
}