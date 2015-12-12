<?php

namespace System;

class VarYanSystem{
    /**
     *
     * */
    private $controller;
    /**
     *
     * */
    private $method = "index";
    /**
     *
     * */
    private $parameters = null;
    /**
     *
     * */
    public function __construct()
    {
        $callParams = Routing::start();

        $this->controller = ucfirst($callParams['controller']);
        $this->method = $callParams['method'];
        $this->parameters = $callParams['parameters'];
        $this->start();
    }

    private function start(){

        $class = "Apps\\Controller\\$this->controller";
        $this->controller = new $class();

        if(method_exists($this->controller,$this->method)){
            $this->controller->{$this->method}($this->parameters);
        }
    }
}