<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 12.12.2015
 * Time: 19:08
 */

namespace System\Helpers\Routing;

class RoutKey
{
    /**
     * @var array $routTypes
     * @default value array
     * */
    private $routTypes;
    /**
     * @var boolean $status
     * @default value boolean false
     * */
    private $status = TRUE;
    /**
     * @var integer $position
     * */
    private $position;
    /**
     * @var string $key
     * @default value string ''
     * */
    private $key = '';
    /**
     * @var array $keyParts
     * @default value array []
     * */
    private $keyParts = array();
    /**
     * __construct method
     * @param string $key
     * @param string $url
     * */
    public function __construct($key, $url)
    {
        $this->routTypes = load_config('route_types');
        $keyParts = explode('/',$key);
        $urlParts = explode('/',$url);
        $paramPosition = 0;

        for($i = 0; $i < sizeof($keyParts); $i++){
            $pos = ($i + 1);
            $this->position = $pos;
            if(array_key_exists($keyParts[$i],$this->routTypes)) {
                if (!preg_match($this->routTypes[$keyParts[$i]], $urlParts[$i])) {
                    $this->status = FALSE;
                    return;
                } else {
                    $this->keyParts[$paramPosition] = $urlParts[$i];
                    $paramPosition++;
                }
            }elseif(strpos($keyParts[$i],'(') !== FALSE){
                //TODO::have to change fro regex
                $this->status = FALSE;
                return;
            }
        }
    }
    /**
     * getKey method
     * @return string
     * */
    public function getKey()
    {
        return $this->key;
    }
    /**
     * getStatus method
     * @return boolean
     * */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * getKeyParts method
     * @return array
     * */
    public function getKeyParts()
    {
        return $this->keyParts;
    }
    /**
     * getKeyPosition method
     * @return integer
     * */
    public function getKeyPosition(){
        return $this->position;
    }
}