<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 14:55
 */
namespace System\Core\Helpers\Model;

trait AsObject
{
    /**
     * all Method
     * @return stdClass object
     * */
    public function allAsObject(){
        return $this->db->getAll()->fetchAll();
    }
    /**
     * one method
     * @param integer $id
     * @return stdClass object
     * */
    public function oneAsObject($id){
        return $this->db->getOne($id)->fetch();
    }
    /**
     * whereAsArray method
     * @param array $where
     * @return stdClass object
     * */
    public function whereAsObject($where){
        return $this->db->getWhere($where)->fetchAll();
    }
    /**
     * oneWhereAsObject method
     * @param array $where
     * @return stdClass object
     * */
    public function oneWhereAsObject($where){
        return $this->db->getWhere($where)->fetch();
    }
}