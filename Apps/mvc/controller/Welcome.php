<?php

namespace Apps\MVC\Controller;
use Plugins\Controller\VarYanController;

class Welcome extends VarYanController
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
    public function index()
    {
        $this->useModel('menu');

        $this->withVars(array(
            'page'  =>'pages/index',
            'menus' =>$this->model->menu->allAsObject()
        ))->renderView('layouts/content');
    }
}