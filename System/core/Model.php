<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 21:31
 */
namespace System\Core;

use System\Core\Helpers\Model\AsArray;
use System\Core\Helpers\Model\AsObject;
use System\Core\Helpers\Model\Table;

abstract class Model
{
    use AsArray;
    use AsObject;
    use Table;
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
     * @throws Error
     * */
    public function __construct($tbName = null)
    {
        $this->db = new Database();
        $this->currentModel = strtolower(array_pop(explode('\\',get_called_class())));
        if(!is_null($tbName))
            $this->db->setTableName($tbName);
        else{
            $name = strtolower($this->currentModel);
            if($this->db->tableExists($name.'s'))
                $this->db->setTableName($name.'s');
            elseif($this->db->tableExists($name))
                $this->db->setTableName($name);
            else throw new Error('tableNotFound',$name);
        }
    }
    /**
     * saveData method
     * @param array $data
     * @param boolean $returnID (default value boolean false)
     * @return integer/boolean
     * @throws Error
     * */
    public function saveData($data,$returnID = false)
    {
        $isValid = $this->beforeSave($data);
        if($isValid === TRUE)
        {
            $result = $this->db->insert($data);
            return ($returnID) ? $this->db->lastInsertedID() : $result;
        }else{
            throw new Error('invalidData',$isValid);
        }
    }
    /**
     * updateData method
     * @param array $where
     * @param array $data
     * @return integer
     * @throws Error
     * */
    public function updateData($where,$data)
    {
        $isValid = $this->beforeSave($data);
        if($isValid === TRUE)
        {
            $this->db->where($where)->update($data);
            return $this->db->rowCount();
        }else{
            throw new Error('invalidData',$isValid);
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