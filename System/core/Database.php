<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 8:53
 */

namespace System\Core;

class Database
{
    /**
     * @var object $query
     * */
    private $lastInsertedID;
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
     * @var string $port
     * @default value null
     * */
    private $charset = 'utf8';
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

        foreach(load_config('database') as $item => $value)
            $this->{$item} = $value;

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
    public function getDB(){
        return $this->db;
    }
    /**
     * makeConnection method
     * */
    private function makeConnection(){
        try{
            $this->db = new \PDO('mysql:host='.$this->host.';dbname='.$this->name, $this->user, $this->pass);
        }catch (\PDOException $ex){
            echo $ex->getMessage();
        }
    }
    /**
     * save method
     * @param array $data
     * @return boolean
     * */
    public function save($data){
        $query = "INSERT INTO ".$this->getTableName();
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
        return $this->makeQuery($query);
    }
    /**
     * getAll method
     * @return stdClass object
     * */
    public function getAll(){
        $query = 'SELECT * FROM '.$this->getTableName();
        $this->makeQuery($query);
        return $this;
    }
    /**
     * getOne method
     * @param integer $id
     * @return stdClass object
     * */
    public function getOne($id){
        $query = "SELECT * FROM ".$this->getTableName()." WHERE ".$this->getTableName().".id = '".$id."'";
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
        $query = "UPDATE ".$this->getTableName()." SET ";
        $counter = 0;
        foreach($data as $item => $value){
            $counter++;
            $query .= $item." = '".$value."' ";
            if($counter < sizeof($data) - 1)
                $query .= ", ";
        }
        $query .= " WHERE ".$this->getTableName().".id = '".$id."'";
        return $this->makeQuery($query);
    }
    /**
     * remove method
     * @param integer $id
     * @return class object
     * */
    public function remove($id){
        $query = "DELETE ".$this->getTableName()." WHERE ".$this->getTableName().".id = '".$id."'";
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
        $query = "SELECT * FROM ".$this->getTableName()." WHERE ";
        $counter = 0;
        foreach($where as $item => $value){
            $counter++;
            $query .= $item." = '".$value."' ";
            if($counter < sizeof($where))
                $query .= " ".$dimension." ";
        }
        $this->makeQuery($query);
        return $this;
    }
    /**
     * getJoin method
     * @param array $tables
     * @structure array(
            array('join_tb1_name','join_tb1_condition','join-type'),
            array('join_tb2_name','join_tb2_condition','join-type'),
     * )
     * */
    public function getJoin($tables){

    }
    /**
     * getSchema method
     * @return stdClass object
     * */
    public function getSchema(){
        $query = "DESCRIBE " . $this->getTableName();
        $this->makeQuery($query);
        return $this;
    }
    /**
     * getTableName method
     * @return string
     * */
    public function getTableName(){
        return $this->prefix.$this->table;
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
     * fetch method
     * @return stdClass object single row
     * */
    public function fetch(){
        $result = $this->query->fetch(\PDO::FETCH_OBJ);
        return $result;
    }
    /**
     * fetchArray method
     * @return array single row
     * */
    public function fetchArray(){
        $result = $this->query->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * fetchAll method
     * @return stdClass object
     * */
    public function fetchAll(){
        $result = $this->query->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }
    /**
     * fetchAll method
     * @return array
     * */
    public function fetchAllArray(){
        $result = $this->query->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * lastInsertedID method
     * @return integer
     * */
    public function lastInsertedID(){
        return $this->lastInsertedID;
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
     * @return boolean
     * */
    private function makeQuery($query){
        $this->query = $this->db->prepare($query);
        $this->query->execute();
        $this->lastInsertedID = !empty($this->db->lastInsertId()) ? $this->db->lastInsertId() : null;
        return $this->query->rowCount() ? true : false;
    }
}