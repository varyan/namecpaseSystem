<?php

$routing = array(
    'default_controller'    =>function($num){
        return "welcome";
    },
    '(.*)'                  =>'welcome',
    'index/(.*)'            =>function(){
        exit();
    }
);