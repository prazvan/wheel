<?php

namespace Models;

use Libraries\DB\DB;

/**
 * Class BaseModel we can assume we have some basic functionality here for all the models
 *
 * @package Models
 */
abstract class BaseModel
{

    /**
     * Mock :) for the sakes of our pseudo-framework-project :)
     *
     * @return \DB|\PDO
     */
    protected function getDB()
    {
        return DB::make()->get();
    }


    /**
     * Pass dynamic instance methods.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }

    /**
     * Dynamically pass methods.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return call_user_func_array([static::make(), $method], $parameters);
    }
}