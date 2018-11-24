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
    public function getUrl()
    {
        return explode('?', substr($_SERVER['REQUEST_URI'], strlen('/')), 2)[0];
    }

    /**
     * @return mixed
     */
    public static function getGetParams()
    {
        $parts = parse_url($_SERVER['REQUEST_URI']);
        if (isset($parts['query'])) {
            parse_str($parts['query'], $getParams);
            return $getParams;
        } else {
            return [];
        }
    }

    /**
     * Router main workplace
     */
    public function run()
    {
        $uri = $this->getUrl();

        if (isset($this->routes[$uri])) {

            $controllerAction = explode('/', $this->routes[$uri]);
        } else {

            $controllerAction = explode('/', $uri);
        }

        $controllerClass = '\\test\\controllers\\' . ucfirst($controllerAction[0]) . 'Controller';

        /**
         * @var $controllerObject Controller
         */
        if (class_exists($controllerClass)) {

            $actionMethod = 'action' . ucfirst($controllerAction[1]);

            $controllerObject = new $controllerClass();

            if (method_exists($controllerObject, $actionMethod)) {

                $controllerObject->$actionMethod();
            } else {

                $controllerObject->actionError();
            }
        } else {

            (new Controller())->actionError();
        }
    }
}