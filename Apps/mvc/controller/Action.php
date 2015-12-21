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
     * register method
     * */
    public function register(){
        $this->useModel('user');
        $data = $_POST;
        $data['password'] = md5($data['password']);
        unset($data['conf_password']);
        $data['createdAt'] = date('Y-m-d H:i:s');
        $data['updatedAt'] = date('Y-m-d H:i:s');

        $save = $this->model->user->saveData($data,true);

        debug_print($save,true);
    }
}