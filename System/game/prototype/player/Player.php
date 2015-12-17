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
     * @var float $speed
     * */
    protected $maxSpeed;
    /**
     * @var float $weight
     * */
    protected $weight;
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
     * getMaxSpeed method
     * @return float
     * */
    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }
    /**
     * setMaxSpeed method
     * @param float $speed
     * */
    public function setMaxSpeed($speed)
    {
        $this->maxSpeed = $speed;
    }
    /**
     * getWeight method
     * @return float
     * */
    public function getWeight()
    {
        return $this->weight;
    }
    /**
     * setWeight method
     * @param float $weight
     * */
    public function setWeight($weight)
    {
        $this->weight = $weight;
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