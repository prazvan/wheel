<?php

namespace App\Repositories\DB;

use Models\Wheel;

class WheelRepository extends Repository
{
    /**
     * Get Wheel from cache or DB
     *
     * @param $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        return $this->cacheQuery('wheel.'.$id, function () use ($id) {
            // assuming Wheel is a facade or we have implemented magic  method __callStatic in the model we we can call the method statically
            return Wheel::getById($id);
        });
    }
}