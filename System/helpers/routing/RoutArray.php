<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 10.12.2015
 * Time: 21:17
 */

namespace System\Helpers\Routing;

class RoutArray
{
    /**
     * @var array $array
     * */
    private $array;
    /**
     * @var array $args
     * */
    private $args;
    /**
     * @use trait RouteParser
     * */
    use RoutParser;
    /**
     * __construct method
     * @param array $array
     * @array array $args
     * */
    public function __construct($array,$args)
    {
        $this->array    = $array;
        $this->args     = $args;
        is_assoc($this->array) ? $this->assocArray() : $this->sequentArray();
        $this->setRouting(implode('/',$this->array).'/'.$this->args);
    }
    /**
     * assocArray method
     * @functionality will collect routing in associative array
     * */
    private function assocArray(){
        if(isset($this->array['args'])) {
            for ($i = 0; $i < sizeof($this->array['args']); $i++) {
                if (strpos($this->array['args'][$i], '$') !== FALSE)
                    $this->array['args'][$i] = str_replace($this->array['args'][$i], $this->args[str_replace('$', '', $this->array['args'][$i])], $this->array['args'][$i]);
            }
            $this->args = implode('/',$this->array['args']);
            unset($this->array['args']);
        }else{
            return true;
        }
    }
    /**
     * assocArray method
     * @functionality will collect routing in sequential array
     * */
    private function sequentArray(){
        if(isset($this->array[2])){
            for ($i = 0; $i < sizeof($this->array[2]); $i++) {
                if (strpos($this->array[2][$i], '$') !== FALSE)
                    $array[2][$i] = str_replace($this->array[2][$i], $this->args[str_replace('$', '', $this->array[2][$i])], $this->array[2][$i]);
            }
            $this->args = implode('/',$this->array[2]);
            unset($this->array[2]);
        }else{
            return true;
        }
    }
}