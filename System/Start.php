<?php

if(!function_exists('VarYanSystem_autoload')){
    /**
     * VarYanSystem_autoload method
     * @param string $className
     * */
    function VarYanSystem_autoload($className){

        $count = 1;
        $className = ltrim($className, '\\');
        $fileName  = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }

        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        $fileName = str_replace('/','\\',preg_replace('/Apps/',APPS,preg_replace('/System/',SYSTEM,$fileName,1),1));

        if(file_exists($fileName)){
            require $fileName;
        }
    }
    /**
     * @functionality registration of new autoload method
     * */
    spl_autoload_register('VarYanSystem_autoload');
}

if(!function_exists('load_class')){
    /**
     * load_class method
     * @param string $className
     * @param string $type
     * */
    function load_class($className,$type = 'Controller'){
        $class = str_replace('\\\\','\\',"Apps\\".str_replace('/','\\',ACTIVE)."\\$type\\$className");
        return new $class();
    }
}

if(!function_exists('load_config')){
    function &load_config($configFileName = 'config'){
        $file = APPS.ACTIVE."config/".$configFileName.".php";

        if(file_exists($file)){
            require "$file";
            return $$configFileName;
        }else{
            throw new \System\Core\Error('configFile',$file);
        }
    }
}

if(!function_exists('load_item')){
    function load_item($key){
        $file = APPS.ACTIVE."config/config.php";
        if(file_exists($file)){
            require "$file";
            if(isset($config[$key])){
                return $config[$key];
            }else{
                return null;
            }
        }else{
            throw new \System\Core\Error('configFileItem',$key);
        }
    }
}

if(!function_exists('is_assoc')){
    function is_assoc($arr, $reusingKeys = FALSE) {
        $range = range(0, count($arr) - 1);
        return $reusingKeys ?  $arr !== $range : array_keys($arr) !== $range;
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

if(!function_exists('get_string_between')){
    function get_string_between($string,$beginning = '[',$end = ']') {
        $beginningPos = strpos($string, $beginning);
        $endPos = strpos($string, $end);
        if ($beginningPos === false || $endPos === false) {
            return $string;
        }

        $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

        return $textToDelete;
    }
}

/**
 * @functionality system Wake Up
 * */
$System = new \System\VarYanSystem();