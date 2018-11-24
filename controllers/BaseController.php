<?php

namespace test\controllers;

use test\components\View;

/**
 * Class BaseController
 * @package controllers
 */
class BaseController
{
    /**
     * Displays defined view while standing on action
     * Unnecessary array of params can be defined to set variables in view and use them right into view
     * @param $view string
     * @param $params array|null
     * @return View
     */
    public function render($view, $params = [])
    {
        $controllerName = str_replace('controller', '', strtolower(explode('\\', get_class($this))[2]));

        $viewObject = new View();
        $viewObject->path = dirname(__FILE__) . '/../views/' . $controllerName . '/' . strtolower($view) . '.php';
        $viewObject->params = $params;
        $viewObject->setAdditionalProperties();

        require_once dirname(__FILE__) . '/../views/layouts/main.php';

        return $viewObject;
    }

    /**
     * Error action that displays when page user has come to not exists
     */
    public function actionError()
    {
        $content = 'Page does not exist';

        require_once dirname(__FILE__) . '/../views/base/error.php';

        require_once dirname(__FILE__) . '/../views/layouts/main.php';
    }
}