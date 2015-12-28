<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/19/2015
 * Time: 11:34 AM
 */

namespace Apps\MVC\Controller;
use Plugins\Controller\VarYanController;
use System\Core\Request;

class Action extends VarYanController
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
    /**
     *
     * */
    public function later()
    {
        $this->useModel('later');
        $data = Request::post();
        $data['ipAddress'] = $_SERVER['REMOTE_ADDR'];
        $data['createdAt'] = date('Y-m-d H:i:s');
        $save = $this->model->later->saveData($data,true);

        debug_print($save,true);
    }
}