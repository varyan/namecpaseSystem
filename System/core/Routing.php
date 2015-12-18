<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 20:59
 */
namespace System\Core;

use System\Core\Helpers\Routing\RoutArray;
use System\Core\Helpers\Routing\RoutFunction;
use System\Core\Helpers\Routing\RoutKey;
use System\Core\Helpers\Routing\RoutObject;
use System\Core\Helpers\Routing\RoutString;

class Routing
{
    /**
     * @var string $url
     * */
    private static $url;
    /**
     * @var array $keyParts
     * */
    private static $keyParts;
    /**
     * @var array $routArray
     * */
    private static $routArray;
    /**
     * @var array $router
     * */
    private static $router;
    /**
     * @var mixed $valueType
     * */
    private static $valueType;
    /**
     * start method
     * @param string $url
     * @return array
     * */
    final public static function start($url)
    {
        self::$routArray = load_config('routing');
        self::$url = $url;

        if(self::$url === '/' || trim(self::$url) === '')
        {
            self::$url = '';
            self::defaultRout();
        }
        else
            self::findCurrentValue();

        return self::$router;

    }
    /**
     * defaultRout method
     * */
    private static function defaultRout()
    {
        if(array_key_exists('default_controller',self::$routArray)){
            self::$valueType = self::$routArray['default_controller'];
            self::detectRoutType();
        }
    }
    /**
     * findCurrentValue method
     * */
    private static function findCurrentValue(){
        if(array_key_exists(self::$url,self::$routArray))
            self::$valueType = self::$routArray[self::$url];
        else
            self::findMatchKeys();

        self::detectRoutType();
    }
    /**
     * detectRoutType method
     * @throws Error
     * */
    private static function detectRoutType()
    {
        if(is_array(self::$valueType))
            self::$router = new RoutArray(self::$valueType,self::$keyParts);
        elseif(is_string(self::$valueType))
            self::$router = new RoutString(self::$valueType,self::$keyParts);
        elseif(is_callable(self::$valueType))
            self::$router = new RoutFunction(self::$valueType,self::$keyParts);
        elseif(is_object(self::$valueType))
            self::$router = new RoutObject(self::$valueType,self::$keyParts);
        else
            throw new Error('undefinedRout',array(
                'url'=>self::$url
            ));

        self::$router = self::$router->getRouter();
    }
    /**
     * findMatchKeys method
     * */
    private static function findMatchKeys()
    {
        $keysMatch = array();
        $keysMatchStart = array();

        if(array_key_exists('default_controller',self::$routArray))
            unset(self::$routArray['default_controller']);

        $urlParts = explode('/',self::$url);

        foreach(array_keys(self::$routArray) as $key){
            $routeParts = explode('/',$key);
            if(sizeof($routeParts) == sizeof($urlParts)){
                if($routeParts[0] == $urlParts[0])
                    $keysMatchStart[$key] = self::$routArray[$key];
                else
                    $keysMatch[$key] = self::$routArray[$key];
            }
        }

        self::$routArray = (sizeof($keysMatchStart) > 0) ? $keysMatchStart : $keysMatch;
        self::advanceValue();
    }
    /**
     * advanceValue method
     * */
    private static function advanceValue(){
        $counter = 0;
        foreach(array_keys(self::$routArray) as $key) {
            $counter++;
            $routKey = new RoutKey($key, self::$url);
            if($routKey->getStatus() === TRUE){
                self::$valueType    = self::$routArray[$key];
                self::$keyParts     = $routKey->getKeyParts();
                return;
            }else{
                if($counter == sizeof(self::$routArray))
                    throw new Error('invalidRout',array(
                        'paramPosition'=>$routKey->getKeyPosition()
                    ));
            }
        }
    }
}