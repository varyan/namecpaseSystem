<?php

namespace Apps\Enzum\Controller;
use Plugins\Controller\VarYanController;
use System\Core\Asset;

class Welcome extends VarYanController
{
    /**
     * __construct method
     * */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * page method
     * @param string $current
     * */
    public function page($current = 'index')
    {

        $file = ROOT.'assets/js/site/'.$current.'.js';

        if(file_exists($file)){
            Asset::add('js','site/'.$current);
        }

        $this->withVars(array(
            'page'  =>'pages/'.$current,
        ))->renderView('layouts/content');
    }
}