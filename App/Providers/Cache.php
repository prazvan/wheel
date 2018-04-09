<?php

namespace App\Providers\Cache;

/**
 * Class Cache
 */
class Cache
{
    /**
     * I would use a Caching Library or build a custom one to siuts the needs for caching.
     * implement a cache api with "Drivers" so we can change between caching backends like memcached or Redis or even a nonSQL DB?
     * And implement a Facade/Class as an Abstract Layer for that :)
     *
     * @var \Redis|\Memcached $store
     */
    private $store;

    /**
     * Get Item from Cache
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key = null)
    {
        return $this->store->get(($key));
    }

    /**
     * Store item in Cache
     *
     * @param string $key
     * @param string $value
     * @param int $minutes
     *
     * @return bool
     */
    public function put($key, $value, $minutes = 0): bool
    {
        return (bool) $this->store->put($key, $value, $minutes);
    }

    /**
     * Get an item from the cache, or store the default value.
     *
     * @param  string  $key
     * @param  \DateTime|int  $minutes
     * @param  \Closure  $callback
     * @return mixed
     */
    public function remember($key, $minutes, Closure $callback)
    {
        // If the item exists in the cache we will just return this immediately
        // otherwise we will execute the given Closure and cache the result
        // of that execution for the given number of minutes in storage.
        if (! is_null($value = $this->get($key)))
        {
            return $value;
        }

        $this->put($key, $value = $callback(), $minutes);

        return $value;
    }

    /**
     * Delete Item from Cache
     *
     * @param $key
     *
     * @return bool
     */
    public function forget($key) : bool
    {
        $this->store->delete($key);
    }
}