<?php

/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/17/2015
 * Time: 5:46 PM
 */

namespace System\Core\Prototype;

use System\Core\Error;

abstract class Validator
{
    /**
     * @var object $db
     * */
    private $db;
    /**
     * @var string $error
     * */
    private $error = array();
    /**
     * @var boolean $status
     * @default value boolean true
     * */
    private $status = 'success';
    /**
     * @var array $fields
     * */
    private $fields = array();
    /**
     * @var array $validationTypes
     * */
    private $validationType;
    /**
     * lastError method
     * @return string
     * */
    public function getError()
    {
        return $this->error;
    }
    /**
     * beforeSave method
     * @param array $validationArray
     * */
    abstract public function setRules($validationArray);
    /**
     * beforeSave method
     * @return array/object
    * */
    abstract public function getRules();
    /**
     * finishValidation method
     * @return array
     * */
    protected function finishValidation()
    {
        foreach ($this->fields as $field) {
            for($i = 0; $i < sizeof($field['rules']); $i++){
                $args = array();
                $args[] = isset($_REQUEST[$field['name']]) ? $_REQUEST[$field['name']] : null;
                if(strpos($field['rules'][$i],'[') !== FALSE){

                    $cleanString = get_string_between($field['rules'][$i]);

                    $arg = str_replace('[','',str_replace(']','',$cleanString));
                    $rule = str_replace($cleanString,'',$field['rules'][$i]);

                    switch($rule){
                        case "matchWith":
                            $args[] = isset($_REQUEST[$arg]) ? $_REQUEST[$arg] : null;
                            break;
                        case "between":
                            $betweenParts = explode(',',$arg);
                            if(isset($betweenParts[0])){
                                if(preg_match('/^[0-9]*$/',$betweenParts[0])){
                                    $args[] = $betweenParts[0];
                                }else{
                                    exit('between first argument must be integer');
                                }
                                if(isset($betweenParts[1])){
                                    if(preg_match('/^[0-9]*$/',$betweenParts[1])){
                                        $args[] = $betweenParts[1];
                                    }else{
                                        exit('between second argument must be integer');
                                    }
                                }else{
                                    exit('between second argument is required');
                                }
                            }else{
                                exit('between first argument is required');
                            }
                            break;
                    }
                    $args[] = $arg;
                }else{
                    $rule = $field['rules'][$i];
                }
                $key = str_replace('[','',str_replace(']','',$rule));
                if(!call_user_func_array($this->getValidationTypes()[$key],$args))
                    $this->error[$field['label']] = $key;
            }
        }

        $this->status = (sizeof($this->getError()) > 0) ? 'error' : 'success';
    }
    /**
     * validationArray method
     * @param array $rule
     * @throws Error
     * @return array
     * */
    protected function validationArray($rule)
    {
        $field = isset($rule[0]) ? $rule[0] : null;
        $label = isset($rule[1]) ? $rule[1] : null;
        $rules = isset($rule[2]) ? (is_string($rule[2]) ? explode('|',$rule[2]) : (is_array($rule[2]) ? $rule[2] : null)) : null;

        return array(
            'name'=>$field,
            'label'=>$label,
            'rules'=>$rules,
        );
    }
    /**
     * validationAssoc method
     * @param string $field
     * @param array $details
     * @throws Error
     * @return array
     * */
    protected function validationAssoc($field,$details)
    {
        $label = (isset($details['label']) && !empty($details['label'])) ? $details['label'] : $field;
        $rules = isset($details['rules']) ? (is_string($details['rules']) ? explode('|',$details['rules']) : (is_array($details['rules']) ? $details['rules'] : null)) : null;

        return array(
            'name'=>$field,
            'label'=>$label,
            'rules'=>$rules,
        );
    }
    /**
     * getValidationTypes method
     * @return array
     * */
    public function getValidationTypes()
    {
        $validTypes = load_config('column_valid_types');

        foreach ($validTypes as $item => $value)
            $this->validationType[$item] = $value;

        return $this->validationType;
    }
    /**
     * getStatus method
     * @throws Error
     * @return boolean
     * */
    public function getStatus(){
        foreach ($this->getRules() as $key => $rule) {
            if(is_assoc($rule))
                $this->fields[] = $this->validationAssoc($key,$rule);
            elseif(is_array($rule))
                $this->fields[] = $this->validationArray($rule);
            else
                throw new Error('invalidValidRule',$rule);

        }
        $this->finishValidation();
        return $this->status;
    }
}