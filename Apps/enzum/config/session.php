<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/22/2015
 * Time: 3:42 PM
 */

$session = array(
    'encryption_key'=>\System\Core\Helpers\Other\Generate::token(32),
    'expire_time'   =>20
);