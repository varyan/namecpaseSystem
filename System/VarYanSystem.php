<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 20:59
 */
namespace System;

use System\Core\Error;
use System\Core\Routing;

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
        $this->cleanURL();
        if($this->absoluteURL() === FALSE){
            $callParams = Routing::start($this->url);
            $this->controller = ucfirst($callParams['controller']);
            $this->method = $callParams['method'];
            $this->parameters = (trim($callParams['parameters']) !== '' && trim($callParams['parameters']) !== '/') ? explode('/',$callParams['parameters']) : null;
        }

        $this->start();
    }
    /**
     * start method
     * @throws Error
     * */
    private function start()
    {
        $this->controller = load_class($this->controller);

        if(method_exists($this->controller,$this->method)){
            $this->checker($this->controller);
            is_null($this->parameters)
                ? call_user_func(array($this->controller,$this->method))
                : call_user_func_array(array($this->controller,$this->method),$this->parameters);
        }else{
            throw new Error('controllerMethod',$this->method);
        }
    }
    /**
     * checker method
     * @param string $className
     * @throws Error
     * */
    private function checker($className)
    {
        $object = new \ReflectionClass($className);
        $method = $object->getMethod($this->method);
        $params = $method->getParameters();
        if($method->getNumberOfParameters() > 0){
            if(sizeof($this->parameters) != sizeof($params)){
                for($i = 0; $i < sizeof($params); $i++){
                    if(!$params[$i]->isDefaultValueAvailable()){
                        if(!isset($this->parameters[$params[0]->getPosition()])){
                            throw new Error('methodParam',array('className'=>$className, 'methodName'=>$this->method, 'param'=>$params[$i]));
                        }
                    }
                }
            }else{
                //TODO::Action with correct parameters
            }
        }elseif(sizeof($this->parameters) > 0){
            throw new Error('methodDoNotHaveParam',array('className'=>$className, 'methodName'=>$this->method));
        }
    }
    /**
     * absoluteURL
     * */
    public function absoluteURL()
    {
        $urlParts = explode('/',$this->url);

        if(isset($urlParts[0]) && !empty($urlParts[0]) && $urlParts[0] != '/'){
            $this->controller = ucfirst($urlParts[0]);
            $controller = load_class($this->controller);
            if($controller === FALSE)
                return false;
            if(isset($urlParts[1]) && !empty($urlParts[1]) && $urlParts[1] != '/'){
                if(!method_exists($controller,$urlParts[1])){
                    return false;
                }else{
                    $this->method = $urlParts[1];
                    $this->checker($controller);
                }
                if(isset($urlParts[2]) && $urlParts[2] != '' && $urlParts[2] != '/'){
                    unset($urlParts[0],$urlParts[1]);
                    $this->parameters = array_values($urlParts);
                }
            }
        }else{return false;}

        return true;
    }
    /**
     * cleanURL method
     * */
    private function cleanURL()
    {
        $this->url = strpos(FC_PATH,'index.php') ? substr(FC_PATH,11) : ltrim(FC_PATH,'/');
        $this->prefixDetect();
        return stripcslashes(trim($this->url));
    }
    /**
     * prefixDetect method
     * @throws Error
     * */
    private function prefixDetect()
    {
        $prefix = load_item('rout_prefix');
        if($prefix !== FALSE && !empty($this->url)){
            $urlParts = explode('/',$this->url);
            if(isset($urlParts[0]) && !empty($urlParts[0])){
                if(preg_match($prefix,$urlParts[0])){
                    unset($urlParts[0]);
                    $this->url = (sizeof($urlParts) > 1) ? implode('/',$urlParts) : ((sizeof($urlParts) == 1) ? $urlParts[1] : '');
                }else{
                    throw new Error('invalidRout',array(
                        'paramPosition'=>0
                    ));
                }
            }
        }
    }
}