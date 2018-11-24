<?php

namespace test\components;

/**
 * Class Db
 * Controls database connection
 */
class Db
{
    private static $_instance;

    private function __construct(){}

    private function __clone(){}

    private function __wakeup(){}

    /**
     * @return \PDO
     */
    public static function get()
    {
        if (static::$_instance === null) {
            static::$_instance = self::getConnection();
        }

        return static::$_instance;
    }

    /**
     * Db connection method
     * Tries to connect to database using PDO extension
     * If fails drops exception
     */
    public static function getConnection()
    {
        try {
            $params = include_once __DIR__ . '/../config/main.php';

            self::$_instance = new \PDO(
                'mysql:host=' . $params['host'] . ';dbname=' . $params['dbname'],
                $params['username'],
                $params['password']
            );

            self::$_instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return self::$_instance;

        } catch (\PDOException $e) {
            print "Error: " . $e->getMessage();
            die();
        }
    }
}