<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 16.12.2015
 * Time: 19:40
 */

namespace System\Game\Prototype\Player\Animal;

use System\Game\Prototype\Player\Humanoid;

class Horse extends Humanoid
{
    /**
     * __construct method
     * @param string $name
     * */
    public function __construct($name)
    {
        parent::__construct($name);
        $this->setNoise('i he he');
    }
}