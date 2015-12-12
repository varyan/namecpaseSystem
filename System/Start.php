<?php

if(!function_exists('my_autoload')){
    /**
     * VarYanSystem_autoload method
     * @param string $className
     * */
    function VarYanSystem_autoload($className){
        $className = ltrim($className, '\\');
        $fileName  = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        if(file_exists($fileName)){
            require $fileName;
        }
    }
    /**
     * @functionality registration of new autoload method
     * */
    spl_autoload_register('VarYanSystem_autoload');
}

if(!function_exists('load_config')){
    function &load_config($config = 'config'){
        $file = APPS."config/".$config.".php";

        if(file_exists($file)){
            require $file;
            return $$config;
        }
    }
}

if(!function_exists('debug_print')){
    /**
     * debug_print method
     * @param array/stdClass $data
     * @param boolean $exit (default value boolean false)
     * */
    function debug_print($data,$exit = false){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if($exit)
            exit;
    }
}

if(!function_exists('debug_dump')){
    /**
     * debug_dump method
     * @param array/stdClass $data
     * @param boolean $exit (default value boolean false)
     * */
    function debug_dump($data,$exit = false){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        if($exit)
            exit;
    }
}

if(!function_exists('debug_export')){
    /**
     * debug_export method
     * @param array/stdClass $data
     * @param boolean $exit (default value boolean false)
     * */
    function debug_export($data,$exit = false){
        echo "<pre>";
        var_export($data);
        echo "</pre>";
        if($exit)
            exit;
    }
}
/**
 * @functionality system Wake Up
 * */
$System = new \System\VarYanSystem();