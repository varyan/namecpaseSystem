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
    protected $model = null;
    /**
     * @var Model class object $model
     * */
    protected $library = null;
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
     * @throws Error
     * */
    protected function __construct($useSameNameModel = false)
    {
        $this->currentController = strtolower(array_pop(explode('\\',get_called_class())));

        $start_use = load_config('start_use');
        $default = isset($start_use['default']) ? $start_use['default'] : array();
        $current = isset($start_use[$this->currentController]) ? $start_use[$this->currentController] : array();
        $useArray = array_merge($default,$current);

        foreach($useArray as $key => $value){
            if($value) {
                if(Load::library($key) === FALSE){
                    throw  new Error('libraryNotFound');
                }
            }
        }

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
     * */
    private function loadModel($model = null)
    {
        $currModelName = isset($model) ? $model : $this->currentController;
        $className = ucfirst($currModelName);
        $this->model->{$className} = $this->model->{lcfirst($className)} = Load::model($className);
    }
    /**
     * loadLibrary method
     * @param null/string $library
     * */
    private function loadLibrary($library)
    {
        $className = ucfirst($library);
        $this->library->{$className} = $this->library->{lcfirst($className)} = Load::library($className);
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
    /**
     * useLibrary method
     * @param null/string/array $library
     * @throws Error
     * */
    protected function useLibrary($library = null){
        $this->library = new \stdClass();
        if(!is_null($library)){
            if(is_array($library)){
                for($i = 0; $i < sizeof($library); $i++){
                    $this->loadLibrary($library[$i]);
                }
            }else{
                $this->loadLibrary($library);
            }
        }else{
            throw  new Error('libraryRequired');
        }
    }
}