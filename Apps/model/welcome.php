<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 11.12.2015
 * Time: 22:27
 */

namespace Apps\Model;

use System\Core\Model;

class Welcome extends Model
{
    public function __construct()
    {
        parent::__construct('welcome');
    }
}