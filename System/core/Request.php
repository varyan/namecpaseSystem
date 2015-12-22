<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 20.12.2015
 * Time: 12:00
 */

namespace System\Core;

class Request
{
    /**
     * post method
     * @param string $key (default value null)
     * @return null/array
     * */
    public static function post($key = null)
    {
        return !is_null($key) ? (isset($_POST[$key]) ? escapeshellarg(htmlspecialchars($_POST[$key])) : null) : $_POST;
    }
    /**
     * get method
     * @param string $key (default value null)
     * @return null/array
     * */
    public static function get($key = null)
    {
        return !is_null($key) ? (isset($_GET[$key]) ? escapeshellarg(htmlspecialchars($_GET[$key])) : null) : $_GET;
    }
    /**
     * req method
     * @param string $key (default value null)
     * @return null/array
     * */
    public static function req($key = null)
    {
        return !is_null($key) ? (isset($_REQUEST[$key]) ? escapeshellarg(htmlspecialchars($_REQUEST[$key])) : null) : $_REQUEST;
    }
    /**
     * method
     * @return string/null
     * */
    public static function method()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            ? $_SERVER['HTTP_X_REQUESTED_WITH']
            : (isset($_SERVER['REQUEST_METHOD']) && !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null);
    }
}