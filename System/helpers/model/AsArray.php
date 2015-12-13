<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 14:55
 */
namespace System\Helpers\Model;

trait AsArray
{
    /**
     * all Method
     * @return stdClass object
     * */
    public function allAsArray(){
        return $this->db->getAll()->fetchAllArray();
    }
    /**
     * one method
     * @param integer $id
     * @return stdClass object
     * */
    public function oneAsArray($id){
        return $this->db->getOne($id)->fetchArray();
    }
    /**
     * whereAsArray method
     * @param array $where
     * @return array
     * */
    public function whereAsArray($where){
        return $this->db->getWhere($where)->fetchAllArray();
    }
    /**
     * oneWhereAsArray method
     * @param array $where
     * @return array
     * */
    public function oneWhereAsArray($where){
        return $this->db->getWhere($where)->fetchArray();
    }
}