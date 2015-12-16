<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 16.12.2015
 * Time: 19:33
 */

namespace System\Game\Prototype\Player;

abstract class Humanoid extends Player
{
    /**
     * @var string $hitType
     * */
    protected $hitType;
    /**
     * @var string $noise
     * */
    protected $noise;
    /**
     * @var $height
     * */
    protected $height;
    /**
     * @var $age
     * */
    protected $age;
    /**
     * @var $legs
     * */
    protected $legs;
    /**
     * moveRight method
     * @param integer $step
     * @return string
     * */
    public function moveRight($step = 2){
        return "The ".$this->getPlayerType()." ".$this->getName()." moved right by ".$step." step";
    }
    /**
     * moveLeft method
     * @param integer $step
     * @return string
     * */
    public function moveLeft($step = 2){
        return "The ".$this->getPlayerType()." ".$this->getName()." moved left by ".$step." step";
    }
    /**
     * moveUp method
     * @param integer $step
     * @return string
     * */
    public function moveFront($step = 3){
        return "The ".$this->getPlayerType()." ".$this->getName()." moved front by ".$step." step";
    }
    /**
     * moveDown method
     * @param integer $step
     * @return string
     * */
    public function moveBack($step = 1){
        return "The ".$this->getPlayerType()." ".$this->getName()." moved back by ".$step." step";
    }
    /**
     * dead method
     * */
    public function dead(){

    }
    /**
     * noise method
     * */
    public function noise()
    {
        return $this->getName()." say ".$this->getNoise();
    }
    /**
     * getNoise method
     * @return string
     * */
    public function getNoise()
    {
        return $this->noise;
    }
    /**
     * setNoise method
     * @param string $noise
     * */
    public function setNoise($noise)
    {
        $this->noise = $noise;
    }
    /**
     * setHitType method
     * @param string $hitType
     * */
    public function setHitType($hitType)
    {
        $this->hitType = $hitType;
    }
    /**
     * getHitType method
     * @return string
     * */
    public function getHitType()
    {
        return $this->hitType;
    }
}