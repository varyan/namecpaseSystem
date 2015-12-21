<?php

namespace Apps\MVC\Model;
use System\Core\Model;

class User extends Model
{
    /**
     * __construct method
     * */
    public function __construct()
    {
        parent::__construct();
        $this->validator->setRules(array(
            'email'=>array(
                'label'=>'Email address',
                'rules'=>'trim|required|maxLength[50]',
            ),

            'username'=>array(
                'label'=>'Username',
                'rules'=>array('trim', 'required', 'maxLength[50]')
            ),

            array('password', 'Password', array('trim', 'required', 'between[15,50]', 'strongPassword')),

            array('conf_password', 'Confirm password', 'matchWith[password]'),
        ));
    }
}