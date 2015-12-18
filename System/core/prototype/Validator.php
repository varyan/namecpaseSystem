<?php

/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/17/2015
 * Time: 5:46 PM
 */

namespace System\Core\Prototype;

interface Validator
{
    /**
     * getError method
     * */
    public function getError();
    /**
     * beforeSave method
     * @param array $validationArray
     * */
    public function setRules($validationArray);
    /**
     * beforeSave method
     * @return array/object
    * */
    public function getRules();
    /**
     * getStatus method
     * @return boolean
     * */
    public function getStatus();
}