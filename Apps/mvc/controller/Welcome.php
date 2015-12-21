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
    public function index(){
        /**
         * this will load menu model
         * you can load one model like this or more with array('model1','model2',...)
         * */
        $this->useModel('menu');
        /**
         * this will create page and menus variables and send to view
         * the render view will load view file
         * you can create variables with withVars method or pass them as second array parameter to renderView method
         * */
        $this->withVars(array(
            'page'  =>'pages/index',
            'menus' =>$this->model->menu->allAsObject()
        ))->renderView('layouts/content');
    }
}