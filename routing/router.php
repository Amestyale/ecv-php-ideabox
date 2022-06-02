<?php

class Router
{
    public $routes;
    public $prefix = "";

    public function __construct()
    {
        
    }

    public function scope($prefix, $callback)
    {
        $this->prefix = $prefix;
        $callback($this);
        $this->prefix = "";
    }

    public function get($url, $callback)
    {
        $this->buildRoute($url, "GET", $callback);
    }
    
    public function post($url, $callback)
    {
        $this->buildRoute($url, "POST", $callback);
    }

    public function buildRoute($url, $method, $callback)
    {
        $this->routes[] =  new Route($this->prefix.$url, $method, $callback);
    }

    public function render($url)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route) {
            if($route->check($url, $method)) return $route->render($url) ;
        }
    }

}