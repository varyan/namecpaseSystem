<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 16.12.2015
 * Time: 19:34
 */

namespace System\Game\Prototype\Player;

abstract class Player
{
    private $playerType;
    /**
     * @var string $name
     * */
    protected $name;
    /**
     * __construct method
     * @param string $name
     * */
    public function __construct($name)
    {
        $this->playerType = array_pop(explode('\\',get_called_class()));
        $this->setName($name);
    }
    /**
     * getName method
     * @return string
     * */
    public function getName()
    {
        return $this->name;
    }
    /**
     * setName method
     * @param string $name
     * */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * getPlayerType method
     * @return string
     * */
    public function getPlayerType()
    {
        return $this->playerType;
    }
}