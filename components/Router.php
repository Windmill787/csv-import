<?php

namespace test\components;

/**
 * Class Router
 * Controls routes via controllers actions
 */
class Router
{
    private $routes;

    /**
     * Routes file connection constructor
     */
    public function __construct()
    {
        $this->routes = include dirname(__FILE__) . '/../config/routes.php';
    }

    /**
     * Setting base URL address
     */
    private function getURL()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return substr($_SERVER['REQUEST_URI'], strlen('/'));
        }
    }

    /**
     * Router main workplace
     */
    public function run()
    {
        $uri = $this->getURL();
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;
                $controllerFile = dirname(__FILE__) . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include $controllerFile;
                }
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null){
                    break;
                }
            }
        }
    }
}