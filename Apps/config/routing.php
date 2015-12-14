<?php

$routing = array(
    'default_controller'    =>  array('welcome','index'),
    '(s)/(n)'                   =>  array('welcome','page',array('$0','$1'))
);