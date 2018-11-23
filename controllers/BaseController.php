<?php

namespace test\controllers;

/**
 * Class BaseController
 * @package controllers
 */
class BaseController
{
    /**
     * @param $view string
     * @param $params array|null
     */
    public function render($view, $params = [])
    {
        $controllerName = str_replace('controller', '', strtolower(explode('\\', get_class($this))[2]));

        foreach ($params as $variable => $value) {
            $$variable = $value;
        }

        require_once dirname(__FILE__) . '/../views/' . $controllerName . '/' . strtolower($view) . '.php';

        require_once dirname(__FILE__) . '/../views/layouts/main.php';
    }

    public function actionError()
    {
        $content = 'Page does not exist';

        require_once dirname(__FILE__) . '/../views/base/error.php';

        require_once dirname(__FILE__) . '/../views/layouts/main.php';
    }
}