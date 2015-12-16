<?php

/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/16/2015
 * Time: 5:57 PM
 */

namespace System\Game\Prototype;

abstract class Player
{
    /**
     * @var string $name
     * */
    protected $name;
    /**
     * @var integer/float $live (default value 100)
     * */
    protected $live = 100;
    /**
     * @var integer/float $score (default value 0)
     * */
    protected $score = 0;
    /**
     * moveLeft method
     * */
    abstract public function moveLeft();
    /**
     * moveRight method
     * */
    abstract public function moveRight();
    /**
     * moveUp method
     * */
    abstract public function moveUp();
    /**
     * moveDown method
     * */
    abstract public function moveDown();
    /**
     * moveDown method
     * */
    abstract public function hit();
    /**
     * dead method
     * */
    public function dead(){
        return $this->getName().' dead';
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
     * getName method
     * @return string
     * */
    public function getName()
    {
        return $this->name;
    }
    /**
     * getLive method
     * @return integer
     * */
    public function getLive()
    {
        return $this->live;
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
     * getScore method
     * @return integer/float
     * */
    public function getScore()
    {
        return $this->score;
    }
    /**
     * setScore method
     * @param integer/float $score
     * */
    public function setScore($score)
    {
        $this->score = $score;
    }
}