<?php

namespace App\Lib;

class FrontController
{
    private string $controller = 'Index';
    private string $method = 'index';
    private array $params = [];

    const NOT_FOUND_CONTROLLER = 'App\Controllers\\' . 'NotFoundController';
    const NOT_FOUND_METHOD = "notFound";

    public function __construct()
    {
        $this->parseURL();
        Request::init($this->params);
    }

    private function parseURL(): void
    {
        // Get uri and parse it to an array [ controller , method , params[] ]
        $uri = explode("/", trim($_SERVER['REQUEST_URI'], "/"), 3);
        // Set controller from uri
        if (isset($uri[0]) && $uri[0] != '') {
            $this->controller = $uri[0];
        }
        // Set method from uri
        if (isset($uri[1]) && $uri[1] != '') {
            $this->method = $uri[1];
        }
        // Set params from uri
        if (isset($uri[2]) && $uri[2] != '') {
            // Parse params to an array [ param1 , param2, param3 , ... ]
            $this->params = explode("/", trim($uri[2], "/"));
        }
    }

    // Run current controller and method
    public function dispatch(): void
    {
        // Set controller name
        $controllerName = 'App\Controllers\\' . ucfirst($this->controller) . 'Controller';
        if (!class_exists($controllerName)) {
            $controllerName = self::NOT_FOUND_CONTROLLER;
        }

        $controller = new $controllerName();

        // Set method name
        $methodName = $this->method;
        if (!method_exists($controller, $methodName)) {
            $methodName = self::NOT_FOUND_METHOD;
        }

        $controller->setParams($this->params);
        $controller->$methodName();
    }
}
