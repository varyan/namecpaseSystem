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
     * @var string $join
     * */
    private $rowCount = '';
    /**
     * getAll method
     * @param string $table
     * @return Database object
     * */
    public function getAll($table = null)
    {
        if(!is_null($table))
            $this->setTableName($table);

        $this->query("SELECT * FROM ".$this->getTableName());

        return $this;
    }
    /**
     * getOne method
     * @param integer $id
     * @param string $table
     * @return Database object
     * */
    public function getOne($id,$table = null)
    {
        if(!is_null($table))
            $this->setTableName($table);

        $this->select()->from()->where('id',$id)->query();

        return $this;
    }
    /**
     * insert method
     * @param array $data
     * @param string $table
     * @return integer
     * */
    public function insert($data,$table = null)
    {
        if(!is_null($table))
            $this->setTableName($table);

        $this->insert .= " INSERT INTO ".$this->getTableName()." ";
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
        $this->query();
        return $this->rowCount();
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
     * @param array $data
     * @param string $table (default value null)
     * @return integer
     * */
    public function update($data,$table = null)
    {
        if(!is_null($table))
            $this->setTableName($table);

        $this->update .= " UPDATE ".$this->getTableName()." SET ";
        $i = 0;
        foreach($data as $row => $value){$i++;
            $this->update .= $row." = '".$value."'";
            if($i < sizeof($data)){
                $this->update .= ", ";
            }
        }
        $this->update .= " ";
        $this->query();
        return $this->rowCount();
    }
    /**
     * delete method
     * @param string $table (default value null)
     * @return Database object
     * */
    public function delete($table = null)
    {
        if(!is_null($table))
            $this->setTableName($table);

        $this->delete .= " DELETE FROM ".$this->getTableName()." ";
        return $this;
    }
    /**
     * from method
     * @param $table (default value null)
     * @return Database object
     * */
    public function from($table = null)
    {
        if(!is_null($table))
            $this->setTableName($table);

        $this->from = " FROM ".$this->getTableName()." ";
        return $this;
    }
    /**
     * where method
     * @param string/array $where_arr_or_row
     * @param string $dimension_or_value (default value 'and')
     * @return Database object
     * */
    public function where($where_arr_or_row,$dimension_or_value = 'and')
    {
        $this->where = " WHERE ";
        if(is_array($where_arr_or_row)) {
            $counter = 0;
            foreach ($where_arr_or_row as $item => $value) {
                $counter++;
                $this->where .= $item . " = '" . $value . "' ";
                if ($counter < sizeof($where_arr_or_row))
                    $this->where .= " " . $dimension_or_value . " ";
            }
        }else{
            $this->where .= $where_arr_or_row." = '".$dimension_or_value."'";
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
     * tableExists method
     * @param string $table (default value null)
     * @return boolean
     * */
    public function tableExists($table = null)
    {
        if(!is_null($table))
            $this->setTableName($table);

        $this->query("SHOW TABLES LIKE '".$this->getTableName()."'");
        return ($this->rowCount() > 0);
    }
    /**
     * lastInsertedID method
     * @return integer
     * */
    public function lastInsertedID()
    {
        return $this->lastInsertedID;
    }
    /**
     * rowCount method
     * @return integer
     * */
    public function rowCount()
    {
        return $this->rowCount;
    }
    /**
     * createTable method
     * @param string $name
     * @param array $conditions
     * @param string $optional (default value null)
     * @return object Database
     * */
    public function createTable($name,$conditions,$optional = null)
    {
        $this->setTableName($name);

        $this->create .= " CREATE TABLE IF NOT EXISTS ".$this->getTableName()." (";
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
        $this->query();
        return true;
    }
    /**
     * getSchema method
     * @param string $table (default value null)
     * @return stdClass object
     * */
    public function getSchema($table = null)
    {
        if(!is_null($table))
            $this->setTableName($table);

        $this->query("DESCRIBE " . $this->getTableName());
        return $this;
    }
    /**
     * makeQuery method
     * @param string $query (default value null)
     * @return Database object
     * */
    public function query($query = null){
        $this->query = !is_null($query)
            ? $query :  $this->select.
                        $this->insert.
                        $this->update.
                        $this->delete.
                        $this->create.
                        $this->from.
                        $this->join.
                        $this->where.
                        $this->group.
                        $this->order.
                        $this->limit;

        try{
            $this->query = $this->db->prepare($this->query);
            $this->query->execute();
            $this->rowCount = $this->query->rowCount();
            $this->lastInsertedID = !empty($this->db->lastInsertId()) ? $this->db->lastInsertId() : null;
        }catch (\PDOException $ex){
            debug_print($ex->getMessage(),true);
        }
        return $this;
    }
}