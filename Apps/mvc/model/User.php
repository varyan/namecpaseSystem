<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 11.12.2015
 * Time: 22:27
 */

namespace Apps\MVC\Model;

use System\Core\Helpers\Database\Validator;
use System\Core\Model;

class User extends Model
{
    /**
     * __construct method
     * */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * beforeSave method
     * @param Validator $validator
     * @return null
     * */
    public function beforeSave(Validator $validator)
    {
        $isValid = $validator->setRules(array(
            'email'=>array(
                'label' =>'Email address',
                'rules'=>'trim|required|email|maxLength[50]|minLength[6]',
            ),
            'password'=>array(
                'label' =>'Password',
                'rules'=>array('trim','required','minLength[6]'),
            ),
            array(
                'confirm_password',
                'Password confirmed',
                'required|matchWith[password]'
            )
        ))->getStatus();
        parent::beforeSave($validator);

        if($isValid !== 'success'){
            debug_print($validator->getError(),true);
        }
    }
}