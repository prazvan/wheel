<?php

namespace Libraries\DB;

final class DB
{
    /**
     * @var \PDO
     */
    private $pdo = null;

    /**
     * @var \DB $instance
     */
    private static $instance = null;

    /**
     * DB constructor.
     */
    private function __construct()
    {
        // assuming we use a config class can be a custom one library even a dot env
        $config = Config::get('db');

        $this->pdo = new \PDO($config['dsn'], $config['user'], $config['password'], $config['options'] ?: []);
    }

    /**
     * DB Instance
     *
     * @return \DB
     */
    public static function make(): self
    {
        if (!self::$instance) {
            self::$instance = new static;
        }

        return self::$instance;
    }

    /**
     * Get instance
     *
     * @return \PDO|\Doctrine\DBAL\Connection
     */
    public function get()
    {
        try
        {
            return $this->pdo;
        }
        catch (\PDOException $ex)
        {
            // log db exception
            Logger::log($ex);

            // maybe do some other cool stuff here trigger bots, monitoring system, etc

            // just throw the ex to be handled somewhere else
            throw $ex;
        }
    }
}