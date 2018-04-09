<?php

namespace Models;

use App\Repositories\Helpers\Cacheable;

/**
 * Class User
 * @package Models
 */
class User extends BaseModel
{
    use Cacheable;

    /**
     * Get User Bonuses
     *
     * @param $user_id
     *
     * @return mixed
     */
    public function getBonusesById($user_id)
    {
        try
        {
            $sql_query = "
                SELECT
                    bonus.id,
                    bonus.name,
                    bonus.type
                FROM user_bonuses AS user_bonus
                INNER JOIN bonuses AS bonus ON user_bonus.bonus_id
                INNER JOIN users AS user ON user_bonus.user_id
                WHERE user.id = ?;
            ";

            return $this->getDB()->fetchAssoc($sql_query, [$user_id], [\PDO::PARAM_INT]);
        }
        catch (\PDOException $ex)
        {
            // in case of failure we can do whatever here
            throw $ex;
        }
    }

}