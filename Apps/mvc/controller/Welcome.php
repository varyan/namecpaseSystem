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

        $this->useModel('menu');

        $this->withVars(array(
            'page'  =>'pages/index',
            'menus' =>$this->model->menu->allAsObject()
        ))->renderView('layouts/content');
    }
    /**
     * view method
     * @param string $page
     * */
    public function view($page){
        $page = 'pages/'.$page;

        $this->withVars(array(
            'page'=>$page,
        ))->renderView('layouts/content');
    }
}