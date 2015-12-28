<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/14/2015
 * Time: 12:24 PM
 */

namespace System\Core;

class Validator extends \System\Core\Prototype\Validator{
    /**
     * @var array/stdClass $rules
     * */
    private $rules;
    /**
     * setRules method
     * @param array $validationArray
     * @return Validator object
     * */
    public function setRules($validationArray)
    {
        // TODO: Implement setRules() method.
        $this->rules = $validationArray;
        return $this;
    }
    /**
     *
     * */
    public function getRules()
    {
        // TODO: Implement getRules() method.
        return $this->rules;
    }
}