<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 15:00
 */

namespace System\Core\Helpers\Model;

use System\Core\Prototype\Validator;

trait Table
{
    /**
     *
     * */
    private $errorHandler = true;
    /**
     *
     * */
    private $validator;
    /**
     * schema method
     * @return stdClass object
     * */
    public function schema()
    {
        return $this->db->getSchema()->fetchAll();
    }
    /**
     * beforeSave method
     * @param array $data
     * @return boolean
     * */
    protected function beforeSave($data)
    {

        if(load_item('col_validation') === TRUE){
            $this->validator = new Validator();

            foreach($this->schema() as $column){
                if(array_key_exists($column->Field,$data)){
                    if($this->validator->setItem($column,$data[$column->Field])->isOk() !== TRUE){
                        debug_print($this->validator->lastError(),true);
                    }
                }
            }

            return $this->errorHandler;
        }else{
            return true;
        }
    }
}