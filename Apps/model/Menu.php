<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 22:55
 */

namespace Apps\Model;

use System\Core\Model;

class Menu extends Model
{
    public function __construct()
    {
        parent::__construct('menus');
    }
}