<?php

/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/16/2015
 * Time: 6:17 PM
 */

namespace System\Game\Prototype\Human;

use System\Game\Prototype\Player;

abstract class Human extends Player
{
    /**
     * @var integer $legs
     * */
    protected $legs = 2;
    /**
     * shout method
     * */
    abstract protected function shout();
}