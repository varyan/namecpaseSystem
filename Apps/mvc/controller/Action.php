<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/19/2015
 * Time: 11:34 AM
 */

namespace Apps\MVC\Controller;

use System\Core\Controller;

class Action extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     *
     * */
    public function register(){
        debug_print($_POST,true);
    }
}