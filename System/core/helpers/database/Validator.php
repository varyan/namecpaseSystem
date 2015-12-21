<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 15:06
 */

namespace System\Core\Helpers\Database;

class Validator extends \System\Core\Prototype\Validator
{
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