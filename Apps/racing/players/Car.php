<?php

/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/17/2015
 * Time: 10:04 AM
 */

namespace Apps\Racing\Players;

class Car extends \System\Game\Prototype\Player\Vehicle\Car
{
    public function __construct($name, $params)
    {
        parent::__construct($name, $params);
    }
}