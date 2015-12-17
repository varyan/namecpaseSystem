<?php

/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/17/2015
 * Time: 9:43 AM
 */

namespace System\Game\Prototype\Player\Vehicle;
use System\Game\Prototype\Player\Vehicle;
use System\Game\Prototype\Player\Vehicle\Details\Well;

abstract class Car extends Vehicle
{
    /**
     * @var integer $wheels
     * */
    protected $wheels;
    /**
     * getWheels method
     * @return integer
     * */
    public function getWheels()
    {
        return $this->wheels;
    }
    /**
     * setWheels method
     * @param Well $well
     * */
    public function setWheels(Well $well)
    {
        $this->wheels = new \stdClass();
        $this->wheels->leftFront = $this->wheels->rightFront = $this->wheels->leftBack = $this->wheels->rightBack = $well;
    }
    /**
     * getLeftFrontWell method
     * @return Well object
     * */
    public function getLeftFrontWell()
    {
        return (property_exists($this->wheels,'leftFront')) ? $this->wheels->leftFront : null;
    }
    /**
     * getRightFrontWell method
     * @return Well object
     * */
    public function getRightFrontWell()
    {
        return (property_exists($this->wheels,'rightFront')) ? $this->wheels->rightFront : null;
    }
    /**
     * getLeftBackWell method
     * @return Well object
     * */
    public function getLeftBackWell()
    {
        return (property_exists($this->wheels,'leftBack')) ? $this->wheels->leftBack : null;
    }
    /**
     * getRightBackWell method
     * @return Well object
     * */
    public function getRightBackWell()
    {
        return (property_exists($this->wheels,'rightBack')) ? $this->wheels->rightBack : null;
    }
    /**
     * getAcceleration method
     * @param integer/float $speed
     * @return float
     * */
    protected function getAcceleration(){
        return 0.735*($this->getWeight()/$this->getPower()/60);
    }
    /**
     * getSpeed method
     * @param integer/float $speed
     * @return float
     * */
    public function getSpeed($speed = 100){
        return round($speed*$this->getAcceleration(),2);
    }
}