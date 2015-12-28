<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/22/2015
 * Time: 1:28 PM
 */

namespace System\Core\Helpers\Other;

class Generate
{
    /**
     * Token method
     * @param integer $length
     * @param boolean $md5 (default true)
     * @return string
     * */
    public static function token($length = 24,$md5 = false)
    {
        $characters = load_item('token','generate')['characters'];
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return ($md5) ? md5($randomString.round(microtime(true) * 1000)) : $randomString;
    }
    /**
     * mvc method
     * @param string $classType
     * @param array $args
     * */
    public static function mvc($classType,$args)
    {

    }
}