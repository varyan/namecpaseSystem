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
     * @return string
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
        ($refresh === TRUE) ? header('Refresh:0;url='.$url) : header('Location: '.$url, TRUE);
    }
}