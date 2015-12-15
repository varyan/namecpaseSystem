<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 21:30
 */

namespace Apps\Controller;
use System\Core\Controller;
use System\Core\URL;

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

        URL::requestMethod();

        $this->renderView('index',array(
            'menus'=>$this->model->menu->allAsObject()
        ));
    }
}