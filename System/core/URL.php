<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 14.12.2015
 * Time: 22:47
 */

namespace System\Core;

trait URL
{
    /**
     * item method
     * @param $number (default value 0)
     * @return string/null
     * */
    public static function item($number = 0)
    {
        $current = explode('/',ltrim($_SERVER["REQUEST_URI"],'/'));
        $current = (isset($current[$number]) && !empty($current[$number])) ? $current[$number] : null;
        return $current;
    }
    /**
     * to method
     * @param string $url
     * @param boolean $refresh (default value boolean false)
     * */
    public static function to($url,$refresh = false)
    {
        ($refresh === TRUE) ? header('Refresh:0;url='.$url) : header('Location: '.$url,TRUE);
    }
    /**
     * previous method
     * @return string/null
     * */
    public static function previous(){
        return (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : null;
    }
    /**
     * requestMethod
     * @return string/null
     * */
    public static function requestMethod(){
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            ? $_SERVER['HTTP_X_REQUESTED_WITH']
            : (isset($_SERVER['REQUEST_METHOD']) && !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null);
    }
    /**
     * base method
     * @param string $url (default value '')
     * @return string
     * */
    public static function base($url = ''){
        $currentUrl = (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])) ? 'https://' : 'http://';
        $currentUrl .= (strpos($url,'http') !== FALSE) ? $url : $_SERVER['HTTP_HOST'].'/'.$url;
        return $currentUrl;
    }
}