<?php

$routing = array(
    'default_controller'    =>  'welcome',
    '(s)'                   =>  function($page){
        return 'welcome/page/'.$page;
    }
);