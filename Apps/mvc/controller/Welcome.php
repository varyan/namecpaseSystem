<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 21:30
 */

namespace Apps\MVC\Controller;
use System\Core\Controller;
use System\Game\Prototype\Animal\Cat;
use System\Game\Prototype\Animal\Dog;

class Welcome extends Controller
{
    /**
     * __construct method
     * */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * index method
     * */
    public function index(){
        $this->useModel('menu');

        $this->renderView('index',array(
            'menus'=>$this->model->menu->allAsObject()
        ));
    }
    public function game(){
        $animalDog = new Dog('Rex');
        $animalCat = new Cat('Kitty');

        echo $animalDog->hit();
    }
}