<?php

namespace test\models;

use test\components\Db;
use test\components\Model;

class Import extends Model
{
    public function importCsv($files)
    {
        $filename = $files["file"]["tmp_name"];

        if($files["file"]["size"] > 0) {

            $file = fopen($filename, "r");

            $db = Db::get();
            $values = '';
            $i = 0;
            $labels = true;

            while (($data = fgetcsv($file, 0, ",")) !== false) {

                if ($labels) {
                    $labels = false;
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

            if (substr($values, -2) == ', ') {
                $values = substr($values, 0, -2);
            }

            $sql = "INSERT INTO " . self::getTableName() . "(`uid`, `name`, `age`, `email`, `phone`, `gender`) VALUES " . $values;
            $db->query($sql);

            // uid, name, age, email, phone, gender
            fclose($file);
        }
    }
}