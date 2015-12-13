<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 10.12.2015
 * Time: 21:17
 */

namespace System\Helpers\Routing;

class RoutString
{
    /**
     * @use trait RouteParser
     * */
    use RoutParser;
    /**
     * __construct method
     * @param string $string
     * @param array $args
     * */
    public function __construct($string,$args)
    {
        $strParts = explode('/',$string);

        for($i = 0; $i < sizeof($strParts); $i++){
            if(strpos($strParts[$i],'$') !== FALSE)
                $strParts[$i] = str_replace($strParts[$i],$args[str_replace('$','',$strParts[$i])],$strParts[$i]);
        }
        $this->setRouting(implode('/',$strParts));
    }
}