<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 08.12.2015
 * Time: 21:08
 */

namespace VSPlugins\Other;

class Convert
{
    /**
     * json method
     * @param stdClass/Array $data
     * @param string $status
     * @param string $message
     * @return json
     * */
    public static function json($data,$status = 'success',$message = ''){
        return json_encode(array(
            'response'  =>$data,
            'status'    =>$status,
            'message'   =>$message
        ),JSON_PRETTY_PRINT);
    }
    /**
     * xml method
     * @param srdClass/Array $data
     * */
    public static function xml($data){

    }
}