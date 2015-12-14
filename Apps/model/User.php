<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 11.12.2015
 * Time: 22:27
 */

namespace Apps\Model;

use System\Core\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->db
            ->select()
            ->from()
            ->where(array(
                'username'=>'davit',
                'password'=>'usta'
            ))
            ->order('username','desc')
            ->limit(5,15)
            ->join(array(
                array('menus','menus.id = users.id'),
                array('welcome','welcome.id = users.id'),
            ))
            ->group(array(
                'id',
                'parent_id'
            ))
            ->query();

        exit;
    }
}