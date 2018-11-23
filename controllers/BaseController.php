<?php

namespace controllers;

/**
 * Class BaseController
 * @package controllers
 */
class BaseController
{
    /**
     * @param $view string
     * @param $params array|null
     * @return bool
     */
    public function render($view, $params = [])
    {
        $controllerName = basename(__FILE__, '.php');

        $viewPath = dirname(__FILE__) . '/views/' . strtolower($controllerName) . '/' . strtolower($view) . 'php';

        require_once dirname(__FILE__) . '../views/layouts/main.php';
        return true;
    }
}