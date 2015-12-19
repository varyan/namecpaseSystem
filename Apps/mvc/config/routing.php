<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/14/2015
 * Time: 12:26 PM
 */

$routing = array(
    'default_controller'    =>  'welcome',
    '(s)'                   =>  function($param){
        exit($param);
    },
);