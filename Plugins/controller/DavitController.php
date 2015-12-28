<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/28/2015
 * Time: 9:47 AM
 */

namespace Plugins\Controller;
use System\Core\Controller;

class DavitController extends Controller
{
    /**
     * __construct
     * @param boolean $useSameNameModel
     * */
    public function __construct($useSameNameModel = false)
    {
        parent::__construct($useSameNameModel);
    }

}