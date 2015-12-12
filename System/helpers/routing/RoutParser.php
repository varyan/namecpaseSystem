<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 11.12.2015
 * Time: 21:41
 */

namespace System\Helpers\Routing;

trait RoutParser
{
    /**
     *
     * */
    protected static $routing;
    /**
     *
     * */
    protected static $key = 'default_controller';
    /**
     *
     * */
    public function getRouter(){
        self::$routing = strpos(self::$routing,'/') ? explode('/',self::$routing) : array(self::$routing);

        $controller = self::$routing[0];
        $method     = isset(self::$routing[1]) ? self::$routing[1] : 'index';
        unset(self::$routing[0],self::$routing[1]);
        $params = implode('/',array_values(self::$routing));

        return array(
            'controller'    =>$controller,
            'method'        =>$method,
            'parameters'    =>$params,
        );
    }
    /**
     *
     * */
    protected function getFuncArgNames($funcName) {
        $f = new \ReflectionFunction($funcName);
        $result = array();
        foreach ($f->getParameters() as $param) {
            $result[] = $param->name;
        }
        return $result;
    }
}