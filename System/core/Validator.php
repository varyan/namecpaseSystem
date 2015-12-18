<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/14/2015
 * Time: 12:24 PM
 */

namespace System\Core;

class Validator implements \System\Core\Prototype\Validator{
    /**
     * @var array/object $rules
     * */
    private $rules;
    /**
     * beforeSave method
     * */
    public function getStatus()
    {
        // TODO: Implement beforeSave() method.
    }
    /**
     * setRules method
     * @param array $validatorArray
     * @return Validator object
     * */
    public function setRules($validatorArray)
    {
        // TODO: Implement setRules() method.
        return $this;
    }
    /**
     * getRules method
     * @return array/object
     * */
    public function getRules()
    {
        // TODO: Implement setRules() method.
        return $this->rules;
    }
    /**
     * getError method
     * @return array
     * */
    public function getError()
    {
        // TODO: Implement getError() method.
    }
}