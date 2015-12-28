<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/28/2015
 * Time: 9:48 AM
 */

namespace Plugins\Model;
use System\Core\Model;

class DavitModel extends Model
{
    /**
     * __construct method
     * @param string/null $tbName (default value null)
     * */
    public function __construct($tbName = null)
    {
        parent::__construct($tbName);
    }
}