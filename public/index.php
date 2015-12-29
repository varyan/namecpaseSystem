<?php

/**
 * set Correct timezone and date format
 * @default timezone is Asia/Yerevan
 * @default format is yyyy-mm-dd hh:ii:ss
 * */
$date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Yerevan'));
$date->format('Y-m-d H:i:s');

/**
 * set correct folders for system,plugins and apps
 * */
$system_path    = "../System";
$plugins_path   = "../Plugins";
$apps_path      = "../Apps";

$template_path  = "assets";

/**
 * set active app folder name
 * */
$active_app     = "enzum";

/**
 * defining FC_FILE and FC_PATH constants
 * @define FC_FILE constant
 * @define FC_PATH constant
 * */
define('FC_FILE',  $_SERVER['PHP_SELF']);
/**
 * define url to the index.php file
 * */

$details = explode('/',FC_FILE);
unset($details[sizeof($details)-1]);
define('FC_PATH',implode('/',$details).'/');

/**
 * define host name
 * */
define('HOST',(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']))
    ? "https://$_SERVER[HTTP_HOST]"
    : "http://$_SERVER[HTTP_HOST]");

/**
 * check is valid folder $system_path
 * @define SYSTEM constant
 * */
if(is_dir($system_path)){
    define("SYSTEM" ,   str_replace('\\',DIRECTORY_SEPARATOR,$system_path).DIRECTORY_SEPARATOR);
}else{
    exit('The system folder dose`nt set correctly');
}

/**
 * check is valid folder $apps_path
 * @define APPS constant
 * */
if(is_dir($apps_path)){
    define("APPS"   ,   str_replace('\\',DIRECTORY_SEPARATOR,$apps_path).DIRECTORY_SEPARATOR);
}else{
    exit('The apps folder dose`nt set correctly');
}

/**
 * check is valid folder $plugins_path
 * @define PLUGINS constant
 * */
if(is_dir($plugins_path)){
    define("PLUGINS",   str_replace('\\',DIRECTORY_SEPARATOR,$plugins_path).DIRECTORY_SEPARATOR);
}else{
    exit('The plugins folder dose`nt set correctly');
}

/**
 * defining ROOT constant
 * @define ROOT constant
 * */
define("ROOT"   ,   dirname(__FILE__).DIRECTORY_SEPARATOR);

/**
 * check is valid folder $template_path
 * @define TEAM constant
 * */
if(is_dir($template_path)){
    define('TEAM'   ,FC_PATH.$template_path.'/');
}else{
    exit('The template folder dose`nt set correctly');
}

/**
 * check is valid folder $apps_path
 * @define ACTIVE constant
 * */
if(is_dir(APPS.$active_app)){
    define("ACTIVE",str_replace('\\',DIRECTORY_SEPARATOR,$active_app.DIRECTORY_SEPARATOR));
}else{
    exit('The active application folder dose`nt set correctly');
}

/**
 * @define TEMPLATE constant
 * */
define('TEMPLATE', HOST.TEAM);

/**
 * so lets start our system
 * */
require_once (SYSTEM.'start.php');