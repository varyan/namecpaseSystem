<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 13.12.2015
 * Time: 8:53
 */

namespace System\Core;

use System\Core\Helpers\Database\Queries;

class Database
{
    use Queries;
    /**
     * @var string $host
     * */
    protected $drive = 'mysql';
    /**
     * @var string $host
     * */
    protected $host = 'localhost';
    /**
     * @var string $user
     * */
    protected $user = 'root';
    /**
     * @var string $pass
     * */
    protected $pass = '';
    /**
     * @var string $name
     * */
    protected $name = '';
    /**
     * @var string $port
     * */
    protected $port = null;
    /**
     * @var string $port
     * */
    protected $charset = 'utf8';
    /**
     * @var string $prefix
     * */
    protected $prefix = '';
    /**
     * @var object $query
     * */
    protected $lastInsertedID;
    /**
     * @var string $table
     * */
    protected $table;
    /**
     * @var $connection
     * */
    protected $db;
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
    protected function makeConnection(){
        try{
            $this->db = new \PDO($this->drive.':host='.$this->host.';dbname='.$this->name, $this->user, $this->pass);
            $this->db->exec("SET NAMES ".$this->charset);
        }catch (\PDOException $ex){
            echo $ex->getMessage();
        }
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
     * @return Database object
     * */
    public function setTableName($tableName){
        $this->table = $tableName;
        return $this;
    }
    /**
     * fetch method
     * @return stdClass object
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
}