<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 10.12.2015
 * Time: 21:17
 */

namespace System\Helpers\Routing;

class RoutFunction
{
    use RoutParser;
    public function __construct($routArray,$url)
    {
        debug_print($this->getFuncArgNames($routArray[self::$key]),true);
        self::$routing = $routArray[self::$key]();
    }

}