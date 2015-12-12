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
     *
     * */
    public function index(){
        echo "Welcome index method";
    }
    /**
     * page method
     * @param $view
     * */
    public function page($view){
        echo "Will load $view view";
    }
}