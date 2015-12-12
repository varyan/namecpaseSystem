<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 20:59
 */
namespace System;
use System\Helpers\Routing\RoutArray;
use System\Helpers\Routing\RoutFunction;
use System\Helpers\Routing\RoutKey;
use System\Helpers\Routing\RoutObject;
use System\Helpers\Routing\RoutString;

class Routing
{
    /**/
    private static $url;
    /**/
    private static $urlParts;
    /**/
    private static $routArray;
    /**/
    private static $router;
    /**/
    private static $currValue;
    /**/
    final public static function start()
    {
        self::$routArray = load_config('routing');
        self::$url = strpos(FC_PATH,'index.php') ? substr(FC_PATH,11) : FC_PATH;

        if(self::$url === '/' || trim(self::$url) === '')
        {
            self::$url = '';
            self::defaultRout();
        }
        else
            self::findCurrentValue();

        return self::$router;

    }
    /**/
    private static function defaultRout()
    {
        if(array_key_exists('default_controller',self::$routArray)){
            self::$currValue = self::$routArray['default_controller'];
            self::detectRoutType();
        }
    }
    /**
     *
     * */
    private static function findCurrentValue(){
        if(array_key_exists(self::$url,self::$routArray))
            self::$currValue = self::$routArray[self::$url];
        else
            self::advanceValue();

        self::detectRoutType();
    }
    /**/
    private static function detectRoutType()
    {
        if(is_array(self::$currValue))
            self::$router = new RoutArray(self::$routArray,self::$urlParts);
        elseif(is_string(self::$currValue))
            self::$router = new RoutString(self::$routArray,self::$urlParts);
        elseif(is_callable(self::$currValue))
            self::$router = new RoutFunction(self::$routArray,self::$urlParts);
        elseif(is_object(self::$currValue))
            self::$router = new RoutObject(self::$routArray,self::$urlParts);
        else
            exit("Undefined rout type");

        self::$router = self::$router->getRouter();
    }
    /**
     *
     * */
    private static function advanceValue(){
        if(array_key_exists('default_controller',self::$routArray))
            unset(self::$routArray['default_controller']);

        $urlParts = explode('/',self::$url);

        foreach(array_keys(self::$routArray) as $key){
            $routeParts = explode('/',$key);
            if(sizeof($routeParts) == sizeof($urlParts)){
                self::$currValue = self::$routArray[$key];
            }
        }
    }
}