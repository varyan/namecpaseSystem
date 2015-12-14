<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 20:59
 */
namespace System;

class VarYanSystem{
    /**
     * @var string $url
     * */
    private $url;
    /**
     * @var string/object $controller
     * */
    private $controller;
    /**
     * @var string $method
     * @default value string 'index'
     * */
    private $method = 'index';
    /**
     * @var array $parameters
     * @default value null
     * */
    private $parameters = null;
    /**
     * __construct method
     * */
    public function __construct()
    {
        if($this->absoluteURL() === FALSE){
            $callParams = Routing::start($this->cleanURL());
            $this->controller = ucfirst($callParams['controller']);
            $this->method = $callParams['method'];
            $this->parameters = (trim($callParams['parameters']) !== '' && trim($callParams['parameters']) !== '/') ? explode('/',$callParams['parameters']) : null;
        }

        $this->start();
    }
    /**
     * start method
     * */
    private function start()
    {
        $class = "Apps\\Controller\\$this->controller";
        $this->controller = new $class();

        if(method_exists($this->controller,$this->method)){
            $this->checker($class);
            is_null($this->parameters)
                ? call_user_func(array($this->controller,$this->method))
                : call_user_func_array(array($this->controller,$this->method),$this->parameters);
        }else{
            exit($class." controller dose`nt have ".$this->method." method");
        }
    }
    /**
     * checker method
     * @param string $className
     * */
    private function checker($className){
        $object = new \ReflectionClass($className);
        $method = $object->getMethod($this->method);
        $params = $method->getParameters();
        if(sizeof($this->parameters) != sizeof($params)){
            for($i = 0; $i < sizeof($params); $i++){
                if(!$params[$i]->isDefaultValueAvailable()){
                    if(!isset($this->parameters[$params[0]->getPosition()])){
                        exit('<b> '.ucfirst($className).' controller </b><b>'.$this->method.' method</b> <b>'.$params[$i]->getName().' parameter</b> dose`nt have default value');
                    }
                }
            }
        }
    }
    /**
     * absoluteURL
     * */
    public function absoluteURL(){
        $urlParts = explode('/',$this->cleanURL());
        if(isset($urlParts[0]) && $urlParts[0] != '' && $urlParts[0] != '/'){
            $this->controller = ucfirst($urlParts[0]);
            $class = "Apps\\Controller\\$this->controller";
            if(!file_exists($class.'.php')){
                return false;
            }else{
                if(isset($urlParts[1]) && $urlParts[1] != '' && $urlParts[1] != '/'){
                    $this->method = $urlParts[1];
                    if(isset($urlParts[2]) && $urlParts[2] != '' && $urlParts[2] != '/'){
                        unset($urlParts[0],$urlParts[1]);
                        $this->parameters = array_values($urlParts);
                    }
                }
            }
        }else{return false;}

        return true;
    }
    /**
     * cleanURL method
     * */
    private function cleanURL(){
        $this->url = strpos(FC_PATH,'index.php') ? substr(FC_PATH,11) : ltrim(FC_PATH,'/');
        return stripcslashes(trim($this->url));
    }
}