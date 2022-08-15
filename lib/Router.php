<?php

namespace App;

namespace App\Lib;

class Router
{
    public static function route(string $requestMethod, string $uri, string|callable $controllerMethod)
    {
        if ($_SERVER['REQUEST_METHOD'] === strtoupper($requestMethod)){
                self::method($uri, $controllerMethod);
        }
        http_response_code(404);
    }

    private static function method(string $uri, string|callable $controllerMethod)
    {
        self::checkAndLoad($uri, $controllerMethod, $_GET);
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