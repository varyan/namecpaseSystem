<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 06.12.2015
 * Time: 12:17
 */

namespace VSPlugins\Chat;

class ChatUser
{
    /**
     * @var integer $userID
     * */
    private $userID;
    /**
     * @var string $firstName
     * */
    private $firstName;
    /**
     * @var string $lastName
     * */
    private $lastName;
    /**
     * @var string $nicName
     * */
    private $nicName;
    /**
     * __construct method
     * @param array $data (default value null)
     * */
    public function __construct($data = null)
    {
        if(!is_null($data)) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
    /**
     * setFirstName method
     * @param string $firstName
     * @return class object
     * */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    /**
     * setLastName method
     * @param string $lastName
     * @return class object
     * */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
    /**
     * setNicName method
     * @param string $nicName
     * @return class object
     * */
    public function setNicName($nicName)
    {
        $this->nicName = $nicName;
        return $this;
    }
    /**
     * getFirstName method
     * @return string
     * */
    final public function getFirstName()
    {
        return $this->firstName;
    }
    /**
     * getLastName method
     * @return string
     * */
    final public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * getNicName method
     * @return string
     * */
    final public function getNicName()
    {
        return $this->nicName;
    }
    /**
     * getFullName method
     * @functionality concat firstName and lastName
     * @return string
     * */
    final public function getFullName(){
        return $this->firstName." ".$this->lastName;
    }
    /**
     * getUserID method
     * @param integer $id
     * @return class object
     * */
    public function setUserID($id){
        $this->userID = $id;
        return $this;
    }
    /**
     * getUserID method
     * @return integer
     * */
    final public function getUserID(){
        return $this->userID;
    }
}