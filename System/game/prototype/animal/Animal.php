<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/16/2015
 * Time: 6:05 PM
 */

namespace System\Game\Prototype\Animal;

use System\Game\Prototype\Player;

abstract class Animal extends Player
{
    /**
     * @var integer $legs
     * */
    protected $legs = 4;
    /**
     * bark method
     * */
    abstract function bark();
}