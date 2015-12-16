<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 11.12.2015
 * Time: 21:41
 */

namespace System\Core\Helpers\Routing;

trait RoutParser
{
    /**
     * @var array $routing
     * */
    private static $routing;
    /**
     * getRouter method
     * @return array
     * */
    public function getRouter()
    {

        $route = $this->getRouting();

        $controller = $route[0];
        $method     = isset($route[1]) ? $route[1] : 'index';
        unset($route[0],$route[1]);
        $params     = isset($route[2]) ? implode('/',array_values($route)) : null;

        return array(
            'controller'    =>  $controller,
            'method'        =>  $method,
            'parameters'    =>  $params,
        );
    }
    /**
     * setRouting method
     * @param mixed $routValue
     * */
    protected function setRouting($routValue)
    {
        self::$routing = $routValue;
        self::$routing = strpos(self::$routing,'/') ? explode('/',self::$routing) : array(self::$routing);
    }
    /**
     * getRouting method
     * @return array
     * */
    protected function getRouting()
    {
        return self::$routing;
    }
}