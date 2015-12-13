<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 10.12.2015
 * Time: 21:17
 */

namespace System\Helpers\Routing;

class RoutObject
{
    /**
     * @use trait RouteParser
     * */
    use RoutParser;
    /**
     * __construct method
     * */
    public function __construct($object,$args)
    {
        echo "rout object";
    }
}