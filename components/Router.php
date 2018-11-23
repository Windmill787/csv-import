<?php

namespace test\components;

/**
 * Class Router
 * Controls routes via controllers and actions
 */
class Router
{
    private $routes;

    /**
     * Router constructor
     */
    public function __construct()
    {
        $this->routes = include dirname(__FILE__) . '/../config/routes.php';
    }

    /**
     * Setting base URL address
     * @return string
     */
    private function getURL()
    {
        return substr($_SERVER['REQUEST_URI'], strlen('/'));
    }

    /**
     * Router main workplace
     */
    public function run()
    {
        $uri = $this->getURL();

        if ($uri && isset($this->routes[$uri])) {

            $controllerAction = explode('/', $this->routes[$uri]);

            $controllerClass = '\\test\\controllers\\' . ucfirst($controllerAction[0]) . 'Controller';
            $actionMethod = 'action' . ucfirst($controllerAction[1]);

            $controllerObject = new $controllerClass();
            $controllerObject->$actionMethod();
        }
    }
}