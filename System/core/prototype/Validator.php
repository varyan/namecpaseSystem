<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 15:06
 */

namespace System\Core\Prototype;

class Validator
{
    /**
     * @var boolean $status
     * @default value boolean true
     * */
    private $status = true;
    /**
     * @var array $validationTypes
     * */
    private $validationTypes;
    /**
     * @var string $error
     * */
    private $error;
    /**
     * __construct method
     * @param null/array $validTypes
     * */
    public function __construct($validTypes = null)
    {
        $this->validationTypes = load_config('column_valid_types');

        if(!is_null($validTypes)) {
            foreach ($validTypes as $item => $value)
                $this->validationTypes[$item] = $value;
        }
    }
    /**
     * setItem method
     * @param stdClass object $column
     * @param string $value
     * @return Validator object
     * */
    public function setItem($column,$value)
    {
        $this->validType($column->Field,$value);
        $this->maxLength($column->Type,$value);
        return $this;
    }
    /**
     * isOk method
     * @return boolean
     * */
    public function isOk(){
        return $this->status;
    }
    /**
     * lastError method
     * @return string
     * */
    public function lastError(){
        return $this->error;
    }
    /**
     * maxLength method
     * @param string $string
     * @param string $value
     * @return boolean
     * */
    private function maxLength($string,$value){
        $maxLength = intval(preg_replace('/[^0-9]+/', '', $string),10);

        if($maxLength != 0 && strlen($value) > $maxLength){
            $this->status = false;
            $this->error = array(
                'handler'   =>  'max_length',
                'length'    =>  $maxLength
            );
            return false;
        }
        return true;
    }
    /**
     * validType method
     * @param string $string
     * @param string $value
     * @return boolean
     * */
    private function validType($string,$value){
        if(array_key_exists($string,$this->validationTypes)){
            if(!$this->validationTypes[$string]($value)){
                $this->status = false;
                $this->error = array(
                    'handler'   =>  'valid_'.$string
                );
                return false;
            }
        }
        return true;
    }
}