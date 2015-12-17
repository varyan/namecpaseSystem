<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/17/2015
 * Time: 9:31 AM
 */

namespace System\Game\Prototype\Player;

abstract class Vehicle extends Player
{
    /**
     * @var string $color
     * */
    protected $color;
    /**
     * @var string $mark
     * */
    protected $mark;
    /**
     * @var string $method
     * */
    protected $model;
    /**
     * @var integer $power
     * */
    protected $power;
    /**
     * __constructor method
     * @param string $name
     * @param array $params
     * */
    public function __construct($name,$params = null)
    {
        parent::__construct($name);
        if(!is_null($params)){
            foreach ($params as $index => $param) {
                if(method_exists($this,'set'.ucfirst($index)))
                    $this->{'set'.ucfirst($index)}($param);
                elseif(property_exists($this,$index))
                    $this->{$index} = $param;
            }
        }
    }
    /**
     * getMark method
     * @return string
     * */
    public function getMark()
    {
        return $this->mark;
    }
    /**
     * getModel method
     * @return string
     * */
    public function getModel()
    {
        return $this->model;
    }
    /**
     * getPower method
     * @return integer
     * */
    public function getPower()
    {
        return $this->power;
    }
    /**
     * getColor method
     * @return string
     * */
    public function getColor()
    {
        return $this->color;
    }
    /**
     * setMark method
     * @param string $mark
     * */
    public function setMark($mark)
    {
        $this->mark = $mark;
    }
    /**
     * setModel method
     * @param string $model
     * */
    public function setModel($model)
    {
        $this->model = $model;
    }
    /**
     * setPower method
     * @param integer $power
     * */
    public function setPower($power)
    {
        $this->power = $power;
    }
    /**
     * setColor method
     * @param string $color
     * */
    public function setColor($color)
    {
        $this->color = $color;
    }
}