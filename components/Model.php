<?php

namespace test\components;

use test\models\Import;

class Model
{
    protected static $tableName;

    public function setProperties()
    {
        $db = Db::get();
        $sql = 'SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ' . "'import'";
        $results = $db->query($sql)->fetchAll();

        foreach ($results as $result) {
            $property = $result[3];
            $this->$property = null;
        }
    }

    public static function getTableName()
    {
        if (self::$tableName === null) {
            $className = explode('\\', get_class(new static()));
            self::$tableName = lcfirst(array_pop($className));
        }

        return self::$tableName;
    }

    public static function findAll()
    {
        try {
            $db = Db::get();
            $models = [];

            $query = "SELECT * FROM " . self::getTableName() . " ORDER BY `id` DESC";
            $results = $db->query($query);
            if ($results) {

                $results = $results->fetchAll();

                foreach ($results as $data) {
                    $model = new Import();
                    $model->setProperties();
                    $model->load($data);
                    $models[] = $model;
                }
            }

            return $models;

        } catch (\PDOException $e) {
            print "Error: " . $e->getMessage();
            die();
        }
    }

    /**
     * @param $array array
     */
    public function load($array)
    {
        foreach ($array as $property => $value) {
            if (property_exists($this, $property)) {

                $this->$property = $value;
            }
        }
    }

    /**
     * @return array
     */
    public function getAttributeLabels()
    {
        $properties = get_object_vars($this);
        $labels = [];
        foreach ($properties as $property => $value) {
            if ($property == 'id') {
                continue;
            }
            $labels[] = $property;
        }
        return $labels;
    }
}