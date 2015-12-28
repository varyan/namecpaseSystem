<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 27.12.2015
 * Time: 21:42
 */

namespace Apps\MVC\Model;
use Plugins\Model\VarYanModel;

class Later extends VarYanModel
{
    public function __construct()
    {
        parent::__construct();
        $this->validator->setRules(array(
           'full_name'=>array(
               'label'=>'Full Name',
               'rules'=>'trim|required|maxLength[50]',
           ),
           'email'=>array(
               'label'=>'Email address',
               'rules'=>'trim|required|validEmail|between[6,50]',
           ),
           'subject'=>array(
               'label'=>'Subject',
               'rules'=>'trim|required|maxLength[50]',
           ),
           'message'=>array(
               'label'=>'Message',
               'rules'=>'trim|required|minLength[10]|maxLength[250]',
           )
        ));
    }
}