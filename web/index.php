<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require(__DIR__ . '/../vendor/autoload.php');

(new test\components\Router())->run();
(new test\components\Db())->getConnection();