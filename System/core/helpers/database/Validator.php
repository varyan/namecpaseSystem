<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 15:06
 */

namespace System\Core\Helpers\Database;

use System\Core\Error;

class Validator implements \System\Core\Prototype\Validator
{
    /**
     * @var boolean $status
     * @default value boolean true
     * */
    private $status = 'success';
    /**
     * @var array $validationTypes
     * */
    private $validationType;
    /**
     * @var string $error
     * */
    private $error = array();
    /**
     * @var array/stdClass $rules
     * */
    private $rules;
    /**
     * @var array $fields
     * */
    private $fields = array();
    /**
     * __construct method
     * @param null/array $validTypes
     * */
    public function __construct()
    {

    }
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
    /**
     * lastError method
     * @return string
     * */
    public function getError()
    {
        return $this->error;
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
     * validationArray method
     * @param array $rule
     * @throws Error
     * @return array
     * */
    private function validationArray($rule)
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
    private function validationAssoc($field,$details)
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
     * finishValidation method
     * @return array
     * */
    private function finishValidation()
    {
        $_REQUEST['email'] = 'admin@ayceqart.am';
        $_REQUEST['password'] = 'varyan007';
        $_REQUEST['confirm_password'] = 'varyan007';

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
}