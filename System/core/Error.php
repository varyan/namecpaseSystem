<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/17/2015
 * Time: 6:06 PM
 */

namespace System\Core;


class Error extends VSError
{
    /**
     * __construct method
     * @param string $type
     * @param array $args
     * */
    public function __construct($type,$args = null)
    {
        parent::__construct($type);
    }
}