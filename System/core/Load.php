<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/22/2015
 * Time: 11:40 AM
 */

namespace System\Core;

class Load
{
    /**
     * model method
     * @param string $className
     * @return boolean/Object
     * */
    public static function model($className)
    {
        $className = ucfirst($className);
        $class = str_replace('\\\\','\\',"Apps\\".str_replace('/','\\',ACTIVE)."\\Model\\$className");
        if(!class_exists($class)){
            return false;
        }
        return new $class();
    }
    /**
     * controller method
     * @param string $className
     * @return boolean/Object
     * */
    public static function controller($className)
    {
        $className = ucfirst($className);
        $class = str_replace('\\\\','\\',"Apps\\".str_replace('/','\\',ACTIVE)."\\Controller\\$className");
        if(!class_exists($class)){
            return false;
        }
        return new $class();
    }
    /**
     * library method
     * @param string $className
     * @return boolean/Object
     * */
    public static function library($className)
    {
        $className = ucfirst($className);
        $class = str_replace('\\\\','\\',"Apps\\".str_replace('/','\\',ACTIVE)."\\Library\\$className");
        if(!class_exists($class)){;
            $class = "System\\Core\\Library\\$className";
            if(!class_exists($class)){
                return false;
            }
        }
        return new $class();
    }
}