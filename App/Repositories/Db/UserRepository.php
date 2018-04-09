<?php

namespace App\Repositories\DB;

use App\Models\User;
use App\Repositories\Repository;

/**
 * Class UserRepository
 */
class UserRepository extends Repository
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getUserById($id)
    {
        return $this->cacheQuery('user.'.$id, function () use ($id) {

            return User::getById($id);

        }, Config::get('Cache')['default_duration']);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getBonusesByUserId($id)
    {
        return $this->cacheQuery('user_bonuses.'.$id, function () use ($id) {

            return User::getBonusesById($id);

        }, Config::get('Cache')['default_duration']);
    }
}