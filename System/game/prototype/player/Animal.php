<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 16.12.2015
 * Time: 19:43
 */

namespace System\Game\Prototype\Player;

abstract class Animal extends Humanoid
{
    protected $legs;
    /**
     * getLegs method
     * @return integer
     * */
    public function getLegs()
    {
        return $this->legs;
    }
    /**
     * setLegs method
     * @param integer $legs
     * */
    public function setLegs($legs)
    {
        $this->legs = $legs;
    }
}