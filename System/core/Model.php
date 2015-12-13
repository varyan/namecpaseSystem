<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 21:31
 */
namespace System\Core;

use System\Helpers\Model\AsArray;
use System\Helpers\Model\AsObject;
use System\Helpers\Model\TablePrototype;

abstract class Model
{
    use AsObject;
    use AsArray;
    use TablePrototype;
    /**
     * @var Database object $database
     * */
    protected $db;
    /**
     * @var string $currentModel
     * */
    private $currentModel;
    /**
     * __construct method
     * @param string $tbName
     * */
    public function __construct($tbName = null)
    {
        $this->db = new Database();
        if(!is_null($tbName))
            $this->db->setTableName($tbName);
        $this->currentModel = strtolower(array_pop(explode('\\',get_called_class())));
    }
    /**
     * saveData method
     * @param array $data
     * @param boolean $returnID (default value boolean false)
     * @return integer/boolean
     * */
    public function saveData($data,$returnID = false){
        $isValid = $this->beforeSave($data);
        if($isValid === TRUE){
            $result = $this->db->save($data);
            return ($returnID) ? $this->db->lastInsertedID() : $result;
        }else{
            debug_print($isValid,true);
        }
    }
    /**
     * updateData method
     * @param integer $id
     * @param array $data
     * @return integer/boolean
     * */
    public function updateData($id,$data){
        if($this->beforeSave($data) === TRUE){
            $this->db->update($id,$data);
        }
    }
    /**
     * removeData method
     * @param integer $id
     * @return integer/boolean
     * */
    public function removeData($id){

    }
}