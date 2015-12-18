<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 21:30
 */

namespace Apps\MVC\Controller;

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
     * index method
     * */
    public function index(){

        $this->useModel(array('user','menu'));

        $this->model->user->saveData(array(
            'username'=>'user',
            'password'=>md5('user123'),
            'email'=>'admin@ayceqart.am',
        ));

        $this->renderView('index',array(
            'menus'=>$this->model->menu->allAsObject()
        ));
    }
}