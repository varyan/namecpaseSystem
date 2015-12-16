<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 19:12
 */

$column_valid_types = array(
    'email'     =>  function ($email){
        return (!filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) ? true : false;
    },
    'ipAddress' =>  function ($ip){
        return (!filter_var($ip, FILTER_VALIDATE_IP) === FALSE) ? true : false;
    },
    'linkURL'   =>  function ($url){
        return (!filter_var($url, FILTER_VALIDATE_URL) === FALSE) ? true : false;
    },
    'createdAt' =>function($date){
        return (date('Y-m-d H:i:s', strtotime($date)) == $date) ? true : false;
    },
    'updatedAt' =>function($date){
        return (date('Y-m-d H:i:s', strtotime($date)) == $date) ? true : false;
    }
);