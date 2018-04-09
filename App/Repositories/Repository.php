<?php

namespace App\Repositories;

use App\Repositories\Helpers\Cacheable;

/**
 * Basic Repository functionality :)
 * Class Repository
 */
abstract class Repository
{
    /**
     * Trait for caching queries
     */
    use Cacheable;

    /**
     * Create new instance of self statically.
     *
     * @return static
     */
    public static function make()
    {
        return new static();
    }
}