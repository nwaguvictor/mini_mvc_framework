<?php

namespace Core;

abstract class BaseController
{
    /**
     * Parameters from matched routes
     * 
     * @var array
     */
    protected $route_params = [];

    /**
     * Constructor class
     * 
     * @param Array $route_params
     * 
     * @return Void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Magic __call Method for inaccessible methods(actions)
     * 
     * @param String $name, the method name,
     * 
     * @param Array $args, Method aeguements
     */
    public function __call($name, $arguments)
    {
        $method = $name . "Action";
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $arguments);
                $this->after();
            }
        } else {
            // echo "Method '$method' not found in controller " . get_class($this);
            throw new \Exception("Method '$method' not found in " . get_class($this));
        }
    }

    /**
     * Before filter - Method to run before invoking the called method
     * 
     * @return Void
     */
    protected function before()
    {
        //
    }

    /**
     * After Filter - method to run after invoking the called method
     * 
     * @return Void
     */
    protected function after()
    {
        //
    }
}
