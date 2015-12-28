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

            'email'=>array(                             // email is the input field name
                'label'=>'Email address',               // label is the name of the filed you want to show user ass not valid field
                'rules'=>'trim|required|maxLength[50]', // rules in this very example is string divided by |
            ),

            'username'=>array(                          // username is the input field name
                'label'=>'Username',                    // label is the name of the filed you want to show user ass not valid field
                'rules'=>array(                         // rules as array
                    'trim',                             // trim (no spaces)
                    'required',                         // required (can not be empty)
                    'maxLength[50]'                     // maxLength[50] (The maximum characters length can be 50)
                )
            ),

            array(
                'password',                             // password is the input field name
                'Password',                             // Password is the label name of the filed you want to show user ass not valid field
                array(                                  // rules as array
                    'trim',                             // trim (no spaces)
                    'required',                         // required (can not be empty)
                    'between[15,50]',                   // between[15,50] (characters length must be between  >= 15 and <= 50)
                    'strongPassword'                    // strongPassword (password filed must contain
                                                                            // at less one uppercase)
                                                                            // at less one lowercase)
                                                                            // at less one digit)
                )
            ),

            array(
                'conf_password',                        // conf_password is the input field name
                'Confirm password',                     // Confirm password is the label name of the filed you want to show user ass not valid field
                'matchWith[password]'),                 // matchWith[password] (this field must have the same characters as password)

        ));
    }
}