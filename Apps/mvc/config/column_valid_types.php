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
    },
    'required' =>function($data){
        return (!empty($data)) ? true : false;
    },
    'trim'      =>function($data){
        return (trim($data)) ? true : false;
    },
    'maxLength' =>function($data,$chars){
        return (strlen($data) <= intval($chars)) ? true : false;
    },
    'minLength' =>function($data,$chars){
        return (strlen($data) >= $chars) ? true : false;
    },
    'between'   =>function($data,$start,$end){
        return (strlen($data) >= $start && strlen($data) <= $end) ? true : false;
    },
    'matchWith' => function($fist,$second){
        return ($fist === $second) ? true : false;
    }
);