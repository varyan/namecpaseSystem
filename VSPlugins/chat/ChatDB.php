<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 06.12.2015
 * Time: 21:41
 */

namespace VSPlugins\Chat;


class ChatDB
{
    /**
     * @var object $query
     * */
    private $query;
    /**
     * @var string $table
     * */
    private $table;
    /**
     * @var $connection
     * */
    private $db;
    /**
     * @var string $host
     * @default value 'localhost'
     * */
    private $host = 'localhost';
    /**
     * @var string $user
     * @default value 'root'
     * */
    private $user = 'root';
    /**
     * @var string $pass
     * @default value ''
     * */
    private $pass = '';
    /**
     * @var string $name
     * @default value ''
     * */
    private $name = '';
    /**
     * @var string $port
     * @default value null
     * */
    private $port = null;
    /**
     * @var string $prefix
     * @default value 'vs_'
     * */
    private $prefix = 'vs_';
    /**
     * __construct method
     * @param array $config
     * */
    public function __construct($config = null)
    {
        if(!is_null($config)){
            foreach ($config as $item => $value) {
                $this->{$item} = $value;
            }
        }
        $this->makeConnection();
    }
    /**
     * getDB method
     * @return stdClass object
     * */
    protected function getDB(){
        return $this->db;
    }
    /**
     * makeConnection method
     * */
    private function makeConnection(){
        try{
            $this->db = new \PDO('mysql:host='.$this->host.';dbname='.$this->prefix.$this->name, $this->user, $this->pass);
        }catch (\PDOException $ex){
            echo $ex->getMessage();
        }
    }
    /**
     * save method
     * @param array $data
     * */
    public function save($data){
        $query = "INSERT INTO ".$this->prefix.$this->table;
        $columns    = " ( ";
        $values = " VALUES( ";
        $counter = 0;
        foreach($data as $item => $value){
            $counter++;
            $values     .= "'".$value."'";
            $columns    .= $item;
            if($counter < sizeof($data)) {
                $values .= ", ";
                $columns .= ", ";
            }
        }
        $query .= $columns.")".$values.") ";
        $this->makeQuery($query);
    }
    /**
     * getAll method
     * @return class object
     * */
    public function getAll(){
        $query = 'SELECT * FROM '.$this->prefix.$this->table;
        $this->makeQuery($query);
        return $this;
    }
    /**
     * getOne method
     * @param integer $id
     * @return class object
     * */
    public function getOne($id){
        $query = "SELECT * FROM ".$this->prefix.$this->table." WHERE ".$this->prefix.$this->table.".id = '".$id."'";
        $this->makeQuery($query);
        return $this;
    }
    /**
     * update method
     * @param integer $id
     * @param array $data
     * @return class object
     * */
    public function update($id,$data){
        $query = "UPDATE ".$this->prefix.$this->table." SET ";
        $counter = 0;
        foreach($data as $item => $value){
            $counter++;
            $query .= $item." = '".$value."' ";
            if($counter < sizeof($data) - 1)
                $query .= ", ";
        }
        $query .= " WHERE ".$this->prefix.$this->table.".id = '".$id."'";
        $this->makeQuery($query);
        return $this;
    }
    /**
     * remove method
     * @param integer $id
     * @return class object
     * */
    public function remove($id){
        $query = "DELETE ".$this->prefix.$this->table." WHERE ".$this->prefix.$this->table.".id = '".$id."'";
        $this->makeQuery($query);
        return $this;
    }
    /**
     * getWhere method
     * @param array $where
     * @param string $dimension (default value 'and')
     * @return class object
     * */
    public function getWhere($where,$dimension = "and"){
        $query = "SELECT * FROM ".$this->prefix.$this->table." WHERE ";
        $counter = 0;
        foreach($where as $item => $value){
            $counter++;
            $query .= $item." = '".$value."' ";
            if($counter < sizeof($where) - 1)
                $query .= " ".$dimension." ";
        }
        $this->makeQuery($query);
        return $this;
    }
    /**
     *
     * */
    public function getJoin($tb2,$condition){

    }
    /**
     * getTableName method
     * @return string
     * */
    public function getTableName(){
        return $this->table;
    }
    /**
     * setTableName method
     * @param string $tableName
     * @return class object
     * */
    public function setTableName($tableName){
        $this->table = $tableName;
        return $this;
    }
    /**
     *
     * */
    public function result(){
        $result = $this->query->fetch(\PDO::FETCH_OBJ);
        return $result;
    }
    /**
     * query method
     * @param string $queryString
     * @return class object
     * */
    public function query($queryString){
        $this->makeQuery($queryString);
        return $this;
    }
    /**
     * makeQuery method
     * @param string $query
     * */
    private function makeQuery($query){
        $this->query = $this->db->prepare($query);
        $this->query->execute();
    }
}