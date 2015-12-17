<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 16.12.2015
 * Time: 19:39
 */

namespace System\Game\Prototype\Player\People;

use System\Game\Prototype\Player\Humanoid;

class Men extends Humanoid
{
    /**
     * __construct method
     * @param string $name
     * */
    public function __construct($name)
    {
        parent::__construct($name);
        $this->setNoise('Barev');
        $this->setHitType('Harvacec');
    }
}