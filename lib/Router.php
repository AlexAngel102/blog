<?php

namespace App;

namespace App\Lib;

class Router
{
    public static function route(string $requestMethod, string $uri, string|callable $controllerMethod)
    {
        if ($_SERVER['REQUEST_METHOD'] === strtoupper($requestMethod)){
            switch ($requestMethod){
                case 'GET':
                    $requestData = $_GET;
                    break;
                case 'POST':
                    $requestData = $_POST;
                    break;
                default:
                    $requestData = [];
            }
                self::method($uri, $controllerMethod, $requestData);
        }
//        http_response_code(404);
    }

    private static function method(string $uri, string|callable $controllerMethod, array $requestData)
    {
        self::checkAndLoad($uri, $controllerMethod, $requestData);
    }

    private static function checkAndLoad(string $uri, string|callable $controllerMethod, array $requestData)
    {
        if ($_SERVER['REQUEST_URI'] === $uri) {
            if (is_callable($controllerMethod)) {
                return call_user_func($controllerMethod);
            }
            if (preg_match('/::/', $controllerMethod)) {
                $arr = explode('::', $controllerMethod);
                $controllers = "App\\Controllers\\" . $arr[0];
                if (class_exists($controllers)) {
                    $controller = new $controllers;
                    $method = $arr[1];
                    if (method_exists($controller, $method)) {
                        return $controller->$method($requestData);
                    }
                }
            }
        }
    }
}