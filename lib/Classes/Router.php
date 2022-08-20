<?php

namespace App\Classes;

class Router
{
    private static array $routs = [];

    public static function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $action = $_SERVER['REQUEST_METHOD'];
        $routs = self::$routs;
        foreach ($routs as $rout) {
            if (in_array($action, $rout)) {
                if (self::ifGET($action, $rout, $uri)) {
                    $result = self::runMethod($rout);
                    return $result;
                }elseif (in_array($uri, $rout)) {
                    $result = self::runMethod($rout);
                    return $result;
                }
            }
        }
        if (!isset($result)){
            http_response_code(404);
        }
    }


    public static function route(string $requestMethod, string $uri, string|callable $controllerMethod)
    {
        switch (strtoupper($requestMethod)) {
            case 'GET':
                $requestData = $_GET;
                break;
            case 'POST':
                $requestData = $_POST;
                break;
        }
        $method = self::methodLoad($controllerMethod);

        self::$routs[] = [
            'uri' => $uri,
            'action' => $requestMethod,
            'method' => $method,
            'data' => $requestData,
        ];
    }

    private static function methodLoad(string|callable $controllerMethod)
    {

        return match (is_callable($controllerMethod)) {
            true => $controllerMethod,
            default => self::methodParse($controllerMethod),
        };
    }

    private static function methodParse(string $controllerMethod)
    {
        if (str_contains($controllerMethod, '::')) {
            $arr = explode('::', $controllerMethod);
            $controllers = "App\\Controllers\\" . $arr[0];
            if (class_exists($controllers)) {
                $controller = new $controllers;
                $method = $arr[1];
                if (method_exists($controller, $method)) {
                    return [
                        'controller' => $controller,
                        'func' => $method];
                }
            }
        }
    }

    private static function ifGET(string $action, array $rout, string $uri)
    {
        $res = trim($rout['uri'], '/');
        if ($action === "GET") {
            if ($res !== "") {
                preg_match("/$res/", $uri, $matches);
                if (isset($matches[0])) {
                    return true;
                }
            }
        }
    }


    private static function runMethod(array $rout)
    {
        switch (is_callable($rout['method'])) {
            case true:
                $result = call_user_func($rout['method']);
                if ($result) {
                    json_encode($result);
                    break;
                }
                return $result;
            default:
                $controller = new $rout['method']['controller'];
                $method = $rout['method']['func'];
                $data = $rout['data'];
                json_encode($controller->$method($data));
        }
    }
}