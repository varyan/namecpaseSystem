<?php

/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 09.12.2015
 * Time: 21:30
 */

namespace Apps\MVC\Controller;

use System\Core\Controller;
use System\Game\Type\FighterCat;
use System\Game\Type\FighterDog;

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
        $fighterDog = new FighterDog('Body');
        $fighterCat = new FighterCat('Kitty');

        debug_print($fighterCat->hit($fighterDog));
        debug_print($fighterCat->getScore());
        debug_print($fighterDog->getLive());
    }
}