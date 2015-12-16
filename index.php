<?php

$date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Yerevan'));
$date->format('Y-m-d H:i:s');

$system_path    = "System";
$plugins_path   = "VSPlugins";
$apps_path      = "Apps";

$active_app     = "mvc";

define("SYSTEM" ,   str_replace('\\','/',$system_path).'/');
define("APPS"   ,   str_replace('\\','/',$apps_path).'/'.$active_app.'/');
define("PLUGINS",   str_replace('\\','/',$plugins_path).'/');
define("ROOT"   ,   str_replace('\\','/',__FILE__).'/');

define("ACTIVE",str_replace('\\','/',$active_app));

define('FC_FILE',  $_SERVER['SCRIPT_NAME']);
define('FC_PATH',  $_SERVER['REQUEST_URI']);
define('TEMPLATE', (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']))
    ? "https://$_SERVER[HTTP_HOST]/".APPS.'view/welcome/'
    : "http://$_SERVER[HTTP_HOST]/".APPS.'view/welcome/');

require_once (SYSTEM.'start.php');