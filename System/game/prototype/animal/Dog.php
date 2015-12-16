<?php

/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/16/2015
 * Time: 6:03 PM
 */

namespace System\Game\Prototype\Animal;

class Dog extends Animal
{
    /**
     * __construct method
     * @param string $name
     * */
    public function __construct($name)
    {
        $this->name = $name;
    }
    /**
     * moveDown method
     * */
    public function moveDown()
    {
        // TODO: Implement moveDown() method.
    }
    /**
     *
     * */
    public function moveLeft()
    {
        // TODO: Implement moveLeft() method.
    }
    /**
     *
     * */
    public function moveRight()
    {
        // TODO: Implement moveRight() method.
    }
    /**
     *
     * */
    public function moveUp()
    {
        // TODO: Implement moveUp() method.
    }
    /**
     *
     * */
    public function bark()
    {
        // TODO: Implement bark() method.
        return "The ".array_pop(explode("\\",__CLASS__))." ".$this->getName()." say haf";
    }
    /**
     *
     * */
    public function hit()
    {
        // TODO: Implement hit() method.
        return "The ".array_pop(explode("\\",__CLASS__))." ".$this->getName()." bites";
    }
}