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
    /**
     * @use trait RouteParser
     * */
    use RoutParser;
    /**
     * @var \ReflectionFunction object $currFunc
     * */
    private $currFunc;
    /**
     * __construct method
     * @param Closure object $func
     * @param array $args
     * */
    public function __construct($func,$args)
    {
        $this->setFunc($func);
        $this->finishRouting($func,$args);
    }
    /**
     * setFunc method
     * @param string $funcName
     * */
    private function setFunc($funcName) {
        $this->currFunc = new \ReflectionFunction($funcName);
    }
    /**
     * getFunc
     * @return \ReflectionFunction object
     * */
    private function getFunc()
    {
        return $this->currFunc;
    }
    /**
     * getArgs method
     * @return array
     * */
    private function getArgs()
    {
        $func = $this->getFunc();
        $args = array();
        foreach($func->getParameters() as $arg){
            $args[] = $arg->name;
        }
        return $args;
    }
    /**
     * getArgsCount method
     * @return integer
     * */
    private function getArgsCount()
    {
        $func = $this->getFunc();
        return $func->getNumberOfParameters();
    }
    /**
     * getRequiredArgsCount method
     * @return integer
     * */
    private function getRequiredArgsCount()
    {
        $func = $this->getFunc();
        return $func->getNumberOfRequiredParameters();
    }
    /**
     * finishRouting method
     * @param Closure object $func
     * @param array $args
     * */
    private function finishRouting($func,$args)
    {
        $this->setRouting(call_user_func_array($func,$args));
    }
}