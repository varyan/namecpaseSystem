<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 06.12.2015
 * Time: 10:27
 */

namespace VSPlugins\Chat;

trait Chatter
{
    /**
     * @var object $db
     * */
    private $db;
    /**
     * @var object $withUser
     * */
    private $withUser;
    /**
     * @var object $currentUser
     * */
    private $currentUser;
    /**
     * __construct method
     * @param array $config (default value null)
     * */
    public function __construct($config = null)
    {
        if(!is_null($config)){
            foreach($config as $item => $value){
                $this->{$item} = $value;
            }
        }
    }
    /**
     * getMessages
     * @return stdClass object
     * */
    final public function getMessages()
    {
        //TODO: will get all messages from messages table
        return $this->db->getAll()->result();
    }
    /**
     * getMessages
     * @param integer $withID
     * @return stdClass object
     * */
    final public function getMessagesWith($withID)
    {
        //TODO: will get all messages between two users from messages table
    }
    /**
     * getMessage
     * @param integer $id
     * @return stdClass object
     * */
    final public function getMessage($id)
    {
        //TODO: will get message from messages table
        return $this->db->getOne($id)->result();
    }
    /**
     * setMessage method
     * @param array $data
     * @return integer
     * */
    final public function setMessage($data)
    {
        //TODO: will get all messages from messages table
        $this->db->save($data);
    }
    /**
     * updateMessage method
     * @param integer $id
     * @param array $data
     * @return boolean
     * */
    final public function updateMessage($id,$data)
    {
        //TODO: will update message in messages table
    }
    /**
     * deleteMessage method
     * @param integer $id
     * @return boolean
     * */
    final public function deleteMessage($id)
    {
        //TODO: will delete message from messages table
    }
    /**
     * setChatUser method
     * @param ChatUser $user
     * @return class object
     * */
    final public function setChatUser(ChatUser $user)
    {
        $this->withUser = $user;
        return $this;
    }
    /**
     * getChatUser method
     * @return ChatUser object
     * */
    final public function getChatUser(){
        return $this->withUser;
    }
    /**
     * setDB method
     * @param ChatDB $db
     * @return class object
     * */
    final public function setDB(ChatDB $db){
        $this->db = $db;
        return $this;
    }
    /**
     * getDB method
     * @return class object
     * */
    final public function getDB(){
        return $this->db;
    }
}