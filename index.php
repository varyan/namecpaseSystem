<?php

$date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Yerevan'));
$date->format('Y-m-d H:i:s');

$system_path    = "System";
$plugins_path   = "VSPlugins";
$apps_path      = "Apps";

define("SYSTEM" ,   str_replace('\\','/',$system_path).'/');
define("APPS"   ,   str_replace('\\','/',$apps_path).'/');
define("PLUGINS",   str_replace('\\','/',$plugins_path).'/');
define("ROOT"   ,   str_replace('\\','/',__FILE__).'/');

define('FC_FILE',  $_SERVER['SCRIPT_NAME']);
define('FC_PATH',  $_SERVER['REQUEST_URI']);
define('TEMPLATE', 'http://varyans.dev/'.APPS.'view/welcome/');

require_once (SYSTEM.'start.php');