<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 21:30
 */
namespace Apps\Controller;
use System\Core\Controller;

class Welcome extends Controller
{
    /**
     * __construct method
     * */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * page method
     * @param $view
     * */
    public function page($view = 'index'){
        $this->renderView($view,array(
            'welcome'=>'Welcome to VarYansSystem '.$view.' page'
        ));
    }
    /**
     *
     * */
    public function modelTests(){
        $this->useModel('user');

        $user = $this->model->user->oneWhereAsObject(array(
            'username'=>'varyan',
            'password'=>md5('admin007')
        ));

        debug_print($user);
    }
}