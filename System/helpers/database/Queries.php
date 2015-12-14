<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/14/2015
 * Time: 5:02 PM
 */

namespace System\Helpers\Database;

trait Queries {
    /**
     * @var object $query
     * */
    protected $query;
    /**
     * @var string $create
     * */
    protected $create = '';
    /**
     * @var string $select
     * */
    protected $select = '';
    /**
     * @var string $from
     * */
    protected $from = '';
    /**
     * @var string $insert
     * */
    protected $insert = '';
    /**
     * @var string $update
     * */
    protected $update = '';
    /**
     * @var string $update
     * */
    protected $delete = '';
    /**
     * @var string $where
     * */
    protected $where = '';
    /**
     * @var string $limit
     * */
    protected $limit = '';
    /**
     * @var string $order
     * */
    protected $order = '';
    /**
     * @var string $group
     * */
    protected $group = '';
    /**
     * @var string $join
     * */
    protected $join = '';
    /**
     * insert method
     * @param string $table
     * @param array $data
     * @return Database object
     * */
    public function insert($table,$data){
        $this->insert .= " INSERT INTO ".$table." ";
        $rows = "("; $values = "("; $i = 0;
        foreach($data as $row => $value){$i++;
            $rows .= $row;
            $values .= "'".$value."'";
            if($i < sizeof($data)){
                $rows .= ","; $values .= ",";
            }
        }
        $rows .= ")"; $values .= ")";
        $this->insert .= $rows." VALUES ".$values;
        return $this;
    }
    /**
     * select method
     * @param string $rows
     * @return Database object
     * */
    public function select($rows = '*')
    {
        $this->select = " SELECT ".$rows." ";
        return $this;
    }
    /**
     * update method
     * @param string $table
     * @param array $data
     * @return Database object
     * */
    public function update($table,$data){
        $this->update .= " UPDATE ".$table." SET ";
        $i = 0;
        foreach($data as $row => $value){$i++;
            $this->update .= $row." = '".$value."'";
            if($i < sizeof($data)){
                $this->update .= ", ";
            }
        }
        $this->update .= " ";
        return $this;
    }
    /**
     * delete method
     * @param string $table
     * @return Database object
     * */
    public function delete($table){
        $this->delete .= " DELETE FROM ".$table." ";
        return $this;
    }
    /**
     * select method
     * @param string $string
     * @param string $type
     * @return Database object
     * */
    /**
     * from method
     * @param $table (default value null)
     * @return Database object
     * */
    public function from($table = null)
    {
        if(is_null($table)){
            if(method_exists($this,'getTableName')){
                $table = $this->getTableName();
            }
        }else{
            if(property_exists($this,'prefix')){
                $table = $this->prefix.$table;
            }
        }
        $this->from = " FROM ".$table." ";
        return $this;
    }
    /**
     * where method
     * @param array $where
     * @param string $dimension (default value)
     * @return Database object
     * */
    public function where(array $where,$dimension = 'and')
    {
        $this->where = " WHERE ";
        $counter = 0;
        foreach($where as $item => $value){
            $counter++;
            $this->where .= $item." = '".$value."' ";
            if($counter < sizeof($where))
                $this->where .= " ".$dimension." ";
        }

        return $this;
    }
    /**
     * limit method
     * @param integer $start_or_limit
     * @param integer $end (default value null)
     * @return Database object
     * */
    public function limit($start_or_limit,$end = null)
    {
        $this->limit = " LIMIT ".$start_or_limit;
        if(!is_null($end))
            $this->limit .= ",".$end." ";

        return $this;
    }
    /**
     * order method
     * @param string/array $col_or_cols
     * @param string $dimension (default value 'asc')
     * @return Database object
     * */
    public function order($col_or_cols,$dimension = 'asc')
    {
        $this->order = " ORDER BY ";
        $counter = 0;
        if(is_array($col_or_cols)){
            foreach($col_or_cols as $item => $value){
                $counter++;
                $this->order .= $item." = '".$value."' ";
                if($counter < sizeof($col_or_cols))
                    $this->order .= ", ";
            }
        }else{
            $this->order .= $col_or_cols." ".strtoupper($dimension);
        }

        return $this;
    }
    /**
     * group method
     * @param string/array $col_or_cols
     * @return Database object
     * */
    public function group($col_or_cols)
    {
        $this->group = (is_array($col_or_cols)) ? " GROUP BY ".implode(',',$col_or_cols) : " GROUP BY ".$col_or_cols;
        return $this;
    }
    /**
     * join method
     * @param string/array $tab_or_tables
     * @param string $condition (default value null)
     * @param string $side (default value 'left')
     * @return Database object
     * */
    public function join($tbl_or_tables,$condition = null,$side = 'left')
    {
        if(is_array($tbl_or_tables)){
            foreach($tbl_or_tables as $tbl){
                $this->join .= isset($tbl[2]) ? " ".strtoupper($tbl[2]) : " ".strtoupper($side)." JOIN ";
                $this->join .= $tbl[0]." ON ".$tbl[1];
            }
        }else{
            $this->join = strtoupper($side)." JOIN ".$tbl_or_tables." ON ".$condition." ";
        }
        $this->join .= " ";
        return $this;
    }
    /**
     * createTable method
     * @param string $name
     * @param array $conditions
     * @param string $optional admin null (optional)
     * @return object Database
     * */
    public function createTable($name,$conditions,$optional = null){
        $this->create .= " CREATE TABLE IF NOT EXISTS ".$name." (";
        $counter = 0;
        foreach($conditions as $row=>$condition){
            $counter++;
            $this->create .= $row." ".$condition;
            if($counter < count($conditions)){
                $this->create .= ", ";
            }
        }
        if($optional != null){
            $this->create .= ", ".$optional;
        }
        $this->create .= ");";
        return $this;
    }
    /**
     * query method
     * @param string $queryString
     * @return Database object
     * */
    public function query($queryString = null){
        $this->query =  $this->select.$this->insert.$this->update.$this->delete.$this->create.$this->from.
            $this->join.$this->where.$this->group.$this->order.$this->limit;

        echo $this->query;

        exit;
    }
}