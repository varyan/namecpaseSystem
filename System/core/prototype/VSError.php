<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/17/2015
 * Time: 5:52 PM
 */

namespace System\Core\Prototype;

abstract class VSError extends \Exception
{
    /**
     * __construct method
     * @param string $type
     * @param array $args (default value null)
     * */
    public function __construct($type,$args = null)
    {
        if(method_exists($this,$type))
            $this->{$type}($args);
        else
            $this->undefinedError($args);
    }
    /**
     * undefinedError method
     * @param array $args
     * */
    private function undefinedError($args){
        debug_print($args,true);
        $args['message'] = 'Undefined error';
    }
    /**
     * undefinedRout method
     * @param array $args
     * */
    private function undefinedRout($args){
        $args['message'] = 'Undefined rout';
        debug_print($args,true);
    }
    /**
     * invalidRout method
     * @param array $args
     * */
    private function invalidRout($args){
        $args['message'] = "The url ".(intval($args['paramPosition'])+1).' parameter has invalid rout type';
        debug_print($args,true);
    }
    /**
     * viewNotFound method
     * @param array $args
     * */
    private function viewNotFound($args){
        $args['message'] = array_pop(explode('/',str_replace('.php','',$args['viewName']))).' view called by '.ucfirst($args['controllerName']).' controller not found';
        debug_print($args,true);
    }
    /**
     * modelNotFound method
     * @param array $args
     * */
    private function modelNotFound($args){
        $args['message'] = array_pop(explode('\\',$args['modelName'])).' model called by '.ucfirst($args['controllerName']).' controller not found';
        debug_print($args,true);
    }
    /**
     *
     * */
    private function methodDoNotHaveParam($args){
        $args['message'] = array_pop(explode('\\',$args['className']))." controller ".$args['methodName'].' method do not required any parameter';
        debug_print($args,true);
    }
}