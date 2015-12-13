<?php

$routing = array(
    'default_controller'    =>  array('welcome','page'),
    '(s)'                   =>  function($page){
        return 'welcome/page/'.$page;
    }
);