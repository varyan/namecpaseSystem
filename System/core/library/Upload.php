<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/22/2015
 * Time: 9:53 AM
 */

namespace System\Core\Library;
use System\Core\Error;
use System\Core\Helpers\Other\Generate;

class Upload
{
    /**
     * @var string $ext
     * */
    private static $ext;
    /**
     * @var string $name
     * */
    private static $name;
    /**
     * @var string $path
     * */
    private static $path;
    /**
     * @var string $type
     * */
    private static $type;
    /**
     * @var array $multiNames
     * */
    private static $multiNames = array();
    /**
     * @var string $tmp_name
     * */
    private static $tmp_name;
    /**
     * @var string $error
     * */
    private static $error;
    /**
     * @var integer $size
     * */
    private static $size;
    /**
     * @var array $allowedTypes
     * */
    private static $allowedTypes = array();
    /**
     * @var integer $maxWidth
     * */
    private static $maxWidth;
    /**
     * @var integer $maxHeight
     * */
    private static $maxHeight;
    /**
     * @var integer $maxSize
     * */
    private static $maxSize;
    /**
     * @var boolean $randomName (default value TRUE)
     * */
    private static $randomName = TRUE;
    /**
     * __construct method
     * @throws Error
     * */
    public function __construct()
    {
        $upload = load_config('upload');
        self::init($upload);
        if(is_null(self::$path)){
            throw new Error('invalidUploadPath',array(
                'invalidPath'=>self::$path
            ));
        }
    }
    /**
     * init method
     * @param array $config
     * */
    public static function init($config)
    {
        self::$allowedTypes = isset($config['allowedTypes'])    ? $config['allowedTypes']                       : array();
        self::$maxWidth     = isset($config['maxWidth'])        ? intval($config['maxWidth'])                   : 1024;
        self::$maxHeight    = isset($config['maxHeight'])       ? intval($config['maxHeight'])                  : 768;
        self::$maxSize      = isset($config['maxSize'])         ? (intval($config['maxSize']) * pow(1024,2))    : 2 * pow(1024,2);
        self::$path         = isset($config['path'])            ? (is_dir($config['path']) ? $config['path']    : null) : ROOT.FC;
        self::$randomName   = isset($config['randomName'])      ? $config['randomName']                         : TRUE;
    }
    /**
     * one method
     * @param string $key
     * */
    public static function one($key)
    {
        $file = self::isFile($key);

        self::$name       =   $file['name'];
        self::$type       =   $file['type'];
        self::$tmp_name   =   $file['tmp_name'];
        self::$error      =   $file['error'];
        self::$size       =   $file['size'];
        self::finish();
    }
    /**
     * multiple method
     * @param string $key
     * @throws Error
     * */
    public static function multiple($key)
    {
        $files = self::isFile($key);

        if(is_array($files['name'])){
            $count = sizeof($files['name']);
        }else{
            throw new Error('useUploadOneMethod');
        }

        for($i = 0; $i < $count; $i++){
            self::$name       =   $files['name'][$i];
            self::$type       =   $files['type'][$i];
            self::$tmp_name   =   $files['tmp_name'][$i];
            self::$error      =   $files['error'][$i];
            self::$size       =   $files['size'][$i];
            self::finish();
        }
    }
    /**
     * isFile method
     * @param string $key
     * @throws Error
     * @return boolean
     * */
    private static function isFile($key)
    {
        if(isset($_FILES[$key]) && $_FILES[$key]['size'] > 0){
            return $_FILES[$key];
        }else{
            throw new Error('uploadDisabled');
        }
    }
    /**
     * finish method
     * @throws Error
     * */
    private static function finish()
    {
        if(self::validate())
        {
            $imgName = self::$name;
            self::$name = (self::$randomName) ? Generate::token(13)."_VarYan`s_".Generate::token(13).'.'.self::$ext : self::$name;
            if(move_uploaded_file(self::$tmp_name,self::$path.self::$name)){
                self::$multiNames[] = self::$name;
            }else{
                throw new Error('canNotUploadFile',array(
                    'error'     =>'Can not upload file',
                    'fileName'  =>$imgName
                ));
            }
        }else
        {
            throw new Error('canNotUploadFile',array(
                'error'=>'Can not upload file '.self::$name
            ));
        }
    }
    /**
     * validate method
     * @throws Error
     * */
    private static function validate()
    {
        $sizeDetails = getimagesize(self::$tmp_name);
        /**
         * @functionality check upload file width
         * */
        if(intval($sizeDetails[0]) > self::$maxWidth){
            throw  new Error('invalidImage',array(
                'maxWidth'          =>self::$maxWidth,
                'currentImageWidth' =>$sizeDetails[0]
            ));
        }
        /**
         * @functionality check upload file height
         * */
        if(intval($sizeDetails[1]) > self::$maxHeight){
            throw  new Error('invalidImage',array(
                'maxHeight'         =>self::$maxHeight,
                'currentImageHeight'=>$sizeDetails[1]
            ));
        }
        /**
         * @functionality check upload file size
         * */
        if(self::$size > self::$maxSize){
            throw  new Error('invalidImage',array(
                'maxSize'           =>round(self::$maxSize/pow(1024,2)),
                'currentImageSize'  =>round(self::$size/pow(1024,2)),
            ));
        }
        /**
         * @functionality check upload file type
         * */
        self::$ext = pathinfo(self::$name,PATHINFO_EXTENSION);
        if(!in_array(strtolower(self::$ext),self::$allowedTypes))
            return false;

        return true;
    }
    /**
     * getUploadedName method
     * @return string
     * */
    public static function getUploadedName(){
        return self::$name;
    }
    /**
     * getUploadedNames method
     * @return array
     * */
    public static function getUploadedNames(){
        return self::$multiNames;
    }

}