<?php

namespace test\components;

/**
 * Class Db
 * Controls database connection
 */
class Db
{
    /**
     * Db connection method
     * Tries to connect to database using PDO extension
     * If fails drops exception
     */
    public function getConnection()
    {
        try {
            $params = include_once __DIR__ . '/../config/main.php';

            $dbh = new \PDO(
                'mysql:host=' . $params['host'] . ';dbname=' . $params['dbname'],
                $params['username'],
                $params['password']
            );

            return $dbh;

        } catch (\PDOException $e) {
            print "Error: " . $e->getMessage();
            die();
        }
    }
}