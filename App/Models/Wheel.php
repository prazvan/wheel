<?php
/**
 * Created by PhpStorm.
 * User: razvan
 * Date: 4/9/18
 * Time: 2:11 PM
 */

namespace Models;

/**
 * Class Wheel
 * @package Models
 */
class Wheel extends BaseModel
{
    use Cacheable;

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        try
        {
            $sql_query = "
                SELECT 
                    id,
                    name -- extra fields can go where :)
                FROM user_wheels 
                WHERE id = ?
            ";

            return $this->getDB()->fetchAssoc($sql_query, [$id], [\PDO::PARAM_INT]);
        }
        catch (\PDOException $ex)
        {
            // in case of failure we can do whatever here
            throw $ex;
        }
    }

}