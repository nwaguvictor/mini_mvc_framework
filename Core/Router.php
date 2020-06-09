<?php

namespace Core;

use Exception;

class Router
{

    // the Routes(URIs) as associative array
    protected $routes = [];

    // Route params
    protected $params = [];

    /** 
     * Add Routes to the routes Array
     * 
     * @param String $route for the route(URL) 
     * @param Array $params for the parameters
     */
    public function add($route, $params = [])
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }

    /** 
     * Gets All Routes 
     * 
     * @return Array of routes
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /** 
     * Match Route in the routes array, setting $params if route is found
     * 
     * @param String $url for the route(URL) 
     * @return Boolean true if route found, false otherwise
     */

    public function match($url)
    {
        $url = trim($url, "/");

        foreach ($this->routes as $route => $params) {

            if (preg_match($route, $url, $matches)) {

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    /** 
     * Gets All currently match params
     * 
     * @return Array of params
     */
    public function getParams()
    {
        return $this->params;
    }

    /** 
     * Dispatch the routes, Create the controller class and matching method
     * @param String $url, the matched url
     * @return Void
     */
    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller . "Controller");
            // $controller = "App\Controllers\\$controller";
            $controller = $this->getNamespace() . $controller;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    // echo "Method '$action' (in controller '$controller') not found";
                    throw new \Exception("Method '$action' (in controller '$controller') not found");
                }
            } else {
                // echo "Controller class '$controller' not found";
                throw new \Exception("Controller class '$controller' not found");
            }
        } else {
            // echo "No route matched";
            throw new Exception("No route matched", 404);
        }
    }

    /**
     * Mutator - convert to StudlyCaps
     * 
     * @param String $string - the string to convert
     * 
     * @return String - the converted string
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', '', $string)));
    }

    /**
     * Mutator - convert to camelCase
     * 
     * @param String $string - the string to convert
     * 
     * @return String - the converted string
     */
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }


    /**
     * Mutator - removes query strings from url
     * 
     * @param String $url - the string to filter
     * 
     * @return String - the filtered string
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('?', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    /**
     * Get the namespace of controller class - the namespace defined in the route parameters
     * 
     * @return String - the request url
     */
    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }
}
