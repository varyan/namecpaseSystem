<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 16.12.2015
 * Time: 23:33
 */

namespace System\Game\Helpers;

use System\Game\Prototype\Player\Humanoid;

trait Fighting
{
    /**
     * @var integer $score
     * */
    protected $score = 0;
    /**
     * @var integer $live
     * */
    protected $live = 100;
    /**
     * @var string $hitType
     * */
    protected $hitType;
    /**
     * hit method
     * @param Humanoid $fighter
     * @return string
     * */
    public function hit(Humanoid $fighter){
        $this->setScore(($this->getScore()+10));

        $currLive = $fighter->getLive();
        $currLive -= 10;

        if($currLive < 0)
            $currLive = 0;

        $fighter->setLive($currLive);

        return  $this->getName()." ".$this->getHitType()." ".$fighter->getName();
    }
    /**
     * setScore method
     * @param integer
     * */
    public function setScore($score)
    {
        $this->score = $score;
    }
    /**
     * getScore method
     * @return integer
     * */
    public function getScore()
    {
        return $this->score;
    }
    /**
     * setLive method
     * @param integer $live
     * */
    public function setLive($live)
    {
        $this->live = $live;
    }
    /**
     * getLive method
     * @return integer
     * */
    public function getLive()
    {
        return $this->live;
    }
}