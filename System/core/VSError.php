<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/17/2015
 * Time: 5:52 PM
 */

namespace System\Core;

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
        $args['message'] = 'Undefined error';
        debug_print($args,true);
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
        $args['message'] = 'Invalid rout';
        debug_print($args,true);
    }
    /**
     * viewNotFound method
     * @param array $args
     * */
    private function viewNotFound($args){
        $args['message'] = 'View not found';
        debug_print($args,true);
    }
    /**
     * modelNotFound method
     * @param array $args
     * */
    private function modelNotFound($args){
        $args['message'] = 'Model not found';
        debug_print($args,true);
    }
}