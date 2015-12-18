<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 15:00
 */

namespace System\Core\Helpers\Model;

use System\Core\Error;
use System\Core\Helpers\Database\Validator;

trait Table
{
    /**
     *
     * */
    private $errorHandler = true;
    /**
     * schema method
     * @return stdClass object
     * */
    public function schema()
    {
        return $this->db->getSchema()->fetchAll();
    }
}