<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 27.12.2015
 * Time: 18:34
 */

namespace System\Core\Prototype;


abstract class Factory
{
    public static function create($class,$args = null)
    {
        return !is_null($args) ? new $class($args) : new $class();
    }
}