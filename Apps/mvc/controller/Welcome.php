<?php

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
    public function index()
    {
        $this->useModel('menu');

        $this->withVars(array(
            'page'  =>'pages/index',
            'menus' =>$this->model->menu->allAsObject()
        ))->renderView('layouts/content');
    }
}