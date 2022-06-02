<?php

class Route
{
    public $url;
    public $method;
    public $callback;
    public $arguments = [];
    
    public function __construct($url, $method, $callback)
    {
        $this->url = $url;
        $this->method = $method;
        $this->callback = $callback;
    }

    public function getArguments($url) : iterable
    {
        $arguments = [];
        $array_url = explode("/", $url);
        foreach (explode("/",$this->url) as $key => $fragment) {
            if(preg_match('/^\:.*$/', $fragment)) $arguments[] = $array_url[$key];
        }

        return $arguments;
    }

    public function getPattern()
    {
        $url = $this->url;
        $url = preg_replace(
            '/\:[^(\/|\\)]+/',
            "([^\/]+)",
            $url);
        $url = preg_replace(
            '/(?<!\\\\)\//',
            '\/',
            $url
        );
        return '/^'.$url.'$/';
    }

    public function check($url, $method)
    {
        if($method != $this->method) return false;
        $match = preg_match($this->getPattern(), $url);
        return $match;
    }

    public function render($url)
    {
        if(is_string($this->callback)){
            $parse = explode("#", $this->callback);
            $obj = new $parse[0];
            $obj->{$parse[1]}(...[...$this->getArguments($url),array_merge($_REQUEST, $_FILES)]);
        } else {
            $function = $this->callback;
            $function();
        }

    }
}