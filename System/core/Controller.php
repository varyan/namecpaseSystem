<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 21:31
 */
namespace System\Core;

abstract class Controller
{
    /**
     * @var Model class object $model
     * */
    protected $model;
    /**
     * @var string $currentController
     * */
    private $currentController;
    /**
     * __construct method
     * @param boolean (default value boolean false)
     * */
    protected function __construct($useSameNameModel = false)
    {
        $this->currentController = strtolower(array_pop(explode('\\',get_called_class())));
        if($useSameNameModel)
            $this->useModel();
    }
    /**
     * renderView
     * @param string $file
     * @param array $args
     * @throws Error
     * */
    protected function renderView($file,$args = null)
    {
        $viewDefault = APPS.'view/'.$this->currentController.'/'.$file.'.php';
        $viewCustom  = APPS.'view/'.$file.'.php';
        $currentView = file_exists($viewCustom) ? $viewCustom : $viewDefault;

        if(file_exists($currentView)){
            if(!is_null($args)) {
                extract($args);
            }
            require_once "$currentView";
        }else{
            throw new Error('viewNotFound',array(
                'viewName'      =>$currentView,
                'controllerName'=>$this->currentController
            ));
        }
    }
    /**
     * loadModel method
     * @param null/string $model
     * @throws Error
     * */
    private function loadModel($model = null)
    {
        $currModelName = isset($model) ? $model : $this->currentController;
        $className = ucfirst($currModelName);
        $class = "Apps\\".ACTIVE."\\Model\\$className";

        if(file_exists(str_replace('\\','/',$class.'.php'))) {
            $this->model->{$className} = new $class();
            $this->model->{lcfirst($className)} = new $class();
        }
        else
            throw new Error('modelNotFound',array(
                'modelName'=>$class,
                'controllerName'=>$this->currentController
            ));
    }
    /**
     * getModel method
     * @return array
     * */
    protected function getModel(){
        return get_object_vars($this->model);
    }
    /**
     * useModel method
     * @param null/string/array $model
     * */
    protected function useModel($model = null){
        $this->model = new \stdClass();
        if(!is_null($model)){
            if(is_array($model)){
                for($i = 0; $i < sizeof($model); $i++){
                    $this->loadModel($model[$i]);
                }
            }else{
                $this->loadModel($model);
            }
        }
        $this->loadModel();
    }
}