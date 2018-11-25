<?php

namespace test\models;

use test\components\Db;
use test\components\Model;

class Import extends Model
{
    // uid, name, age, email, phone, gender
    public $uid;
    public $name;
    public $age;
    public $email;
    public $phone;
    public $gender;

    public function importCsv($files)
    {
        $filename = $files["file"]["tmp_name"];

        if($files["file"]["size"] > 0) {

            try {

                $file = fopen($filename, "r");

                $db = Db::get();
                $values = '';
                $i = 0;
                $labels = true;

                while (($data = fgetcsv($file, 0, ",")) !== false) {

                    if ($labels) {

                        foreach ($data as $label) {
                            if (!property_exists($this, strtolower($label))) {

                                return false;
                            }
                        }

                        $labels = false;
                        continue;
                    }

                    $sql = "SELECT * FROM " . self::getTableName() . " WHERE `uid`=" . $data[0];
                    $rowExists = $db->query($sql)->fetch();

                    if ($rowExists) {

                        $sql = "UPDATE " . self::getTableName() . " SET `name`='$data[1]', `age`='$data[2]', `email`='$data[3]', `phone`='$data[4]', `gender`='$data[5]' WHERE `uid`=" . $data[0];
                        $db->query($sql);
                        continue;
                    }

                    $i++;
                    $values .= "('" . $data[0] . "','" . $data[1] . "','" . $data[2] . "','" . $data[3] . "','" . $data[4] . "','" . $data[5] . "')";
                    if ($i >= 100) {

                        $values .= ')';

                        $sql = "INSERT INTO " . self::getTableName() . "(`uid`, `name`, `age`, `email`, `phone`, `gender`) VALUES " . $values;
                        $db->query($sql);

                        $values = '';
                        $i = 0;
                    } else {
                        $values .= ', ';
                    }
                }

                if ($values) {
                    if (substr($values, -2) == ', ') {
                        $values = substr($values, 0, -2);
                    }

                    $sql = "INSERT INTO " . self::getTableName() . "(`uid`, `name`, `age`, `email`, `phone`, `gender`) VALUES " . $values;
                    $db->query($sql);
                }

                // uid, name, age, email, phone, gender
                fclose($file);

                return true;

            } catch (\PDOException $e) {
                print "Undefined file format";
                die();
            }
        }
    }
}