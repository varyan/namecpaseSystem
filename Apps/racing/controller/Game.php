<?php

/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/17/2015
 * Time: 12:35 PM
 */

namespace Apps\Racing\Controller;

use Apps\Racing\Players\Car;
use System\Core\Controller;
use System\Game\Prototype\Player\Vehicle\Details\Well;

class Game extends Controller
{
    /**
     *
     * */
    public function __construct()
    {
        parent::__construct();
    }

    public function start(){
        $player1Car = new Car('Lamborghini',array(
            'wheels'    =>new Well(),
            'color'     =>'#000000',
            'weight'    =>1650,
            'mark'      =>'Lamborghini',
            'model'     =>'Aventador',
            'maxSpeed'  =>360,
            'power'     =>627
        ));

        $player2Car = new Car('Mercedes-Benz',array(
            'wheels'    => new Well(),
            'color'     =>'rgb(165,165,165)',
            'weight'    =>1410,
            'mark'      =>'Mercedes-Benz',
            'model'     =>'C-230',
            'maxSpeed'  =>240,
            'power'     =>204
        ));

        $player3Car = new Car('BMW',array(
            'wheels'    => new Well(),
            'color'     =>'rgb(116,36,39)',
            'weight'    =>1260,
            'mark'      =>'BMW',
            'model'     =>'M6',
            'maxSpeed'  =>260,
            'power'     =>225
        ));


        debug_print($player1Car->getLeftBackWell(),true);

        $this->renderView('index',array(
            'cars'=>array(
                $player1Car->getName()=>$player1Car,
                $player2Car->getName()=>$player2Car,
                $player3Car->getName()=>$player3Car,
            )
        ));
    }
}