<?php

namespace test\components;

use test\models\Import;

class Model
{
    const SORT_DESC = 'DESC';
    const SORT_ASC = 'ASC';
    const DEFAULT_ORDER_ATTRIBUTE = 'uid';
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

    public static function findAll($getParams = [])
    {
        try {
            $db = Db::get();
            $models = [];

            $orderParam = self::DEFAULT_ORDER_ATTRIBUTE;
            $orderSort = self::SORT_DESC;
            $sortSql = " ORDER BY `$orderParam` " . $orderSort;
            $where = '';

            if ($getParams) {

                foreach ($getParams as $key => $getParam) {
                    if (strstr($key, 'sort')) {

                        $orderParam = $getParam;
                        $orderSort = str_replace('sort', '', $key);
                        $sortSql = " ORDER BY `$orderParam` " . $orderSort;

                    } else {

                        if ($key != 'gender') {
                            if ($where == '') {
                                $where = " WHERE `$key` LIKE '%" . $getParam . "%'";
                            } else {
                                $where .= " AND `$key` LIKE '%" . $getParam . "%'";
                            }
                        } else {
                            if ($getParam) {
                                if ($where == '') {
                                    $where = " WHERE `$key` = '" . $getParam . "'";
                                } else {
                                    $where .= " AND `$key` = '" . $getParam . "'";
                                }
                            }
                        }
                    }
                }
            }

            $query = "SELECT * FROM " . self::getTableName();

            if ($where !== '') {
                $query .= $where;
            }

            $query .= $sortSql;

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
            $labels[] = $property;
        }
        return $labels;
    }

    public static function deleteAll()
    {
        $db = Db::get();
        $query = "DELETE FROM " . self::getTableName();
        $db->query($query);
    }
}