<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/28/2015
 * Time: 4:58 PM
 */

namespace System\Core;

class Asset
{
    /**
     * @var array $assets
     * */
    private static $assets = array();
    /**
     * add method
     * @param string $type
     * @param string/array $fileNames
     * */
    public static function add($type,$fileNames)
    {
        if(is_array($fileNames)){
            for($i = 0; $i < sizeof($fileNames); $i++){
                self::$assets[$type][] = $type.'/'.$fileNames[$i].'.'.$type;
            }
        }else{
            self::$assets[$type][] = $type.'/'.$fileNames.'.'.$type;
        }
    }
    /**
     * getAsset method
     * @param string $type
     * @return array
     * */
    public static function getAssets($type = null)
    {
        return is_null($type) ? self::$assets : (array_key_exists($type,self::$assets) ? self::$assets[$type] : null);
    }
}