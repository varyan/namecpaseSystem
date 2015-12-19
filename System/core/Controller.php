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
     * @var $loadVars
     * */
    private $loadVars = array();
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
        $viewDefault = APPS.ACTIVE.'view/'.$this->currentController.'/'.$file.'.php';
        $viewCustom  = APPS.ACTIVE.'view/'.$file.'.php';
        $currentView = file_exists($viewCustom) ? $viewCustom : $viewDefault;

        if(file_exists($currentView)){
            if(!is_null($args)) {
                $this->withVars($args);
            }
            extract($this->loadVars);
            require "$currentView";
        }else{
            throw new Error('viewNotFound',array(
                'viewName'      =>$currentView,
                'controllerName'=>$this->currentController
            ));
        }
    }
    /**
     * withVars method
     * @param array
     * @return Controller
     * */
    protected function withVars($args){
        /**
         * @functionality will change array/object to array
         * */
        $args = (array)$args;
        /**
         * @functionality will loop throw new vars for view
         * */
        foreach ($args as $key => $val)
            $this->loadVars[$key] = $val;
        /**
         * functionality will merge old assigned params with new vars in one array
         * */
        $this->loadVars = array_merge($this->loadVars,$args);

        return $this;
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
        $this->model->{$className} = $this->model->{lcfirst($className)} = load_class($className,'Model');
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