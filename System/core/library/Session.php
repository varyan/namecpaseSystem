<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/22/2015
 * Time: 3:28 PM
 */

namespace System\Core\Library;
use System\Core\Error;

class Session
{
    /**
     * __construct
     * @var array $args (default value null)
     **/
    public function __construct($args = null)
    {
        $session = load_config('session');
        $config = ($args != null) ? $args : $session;

        if(strlen($config['encryption_key']) < 32)
            exit('To use session you must set encryption key at less 32 symbols');

        session_start();

        if(!isset($_SESSION['session_id']))
            $this->register($config['expire_time'], $config['encryption_key']);

        if(!$this->isRegistered() || $this->isExpired()) $this->end();
    }
    /**
     * __destruct
     */
    public function __destruct()
    {
        unset($this);
    }
    /**
     * register method
     * @param integer $time
     * @param string $id
     */
    protected static function register($time = 60,$id = null)
    {
        if($time == 0) $time = (60*60*24*100);
        $_SESSION['session_id'] = ($id != null) ? $id : session_id();
        $_SESSION['session_time'] = intval($time);
        $_SESSION['session_start'] = self::newTime();
    }
    /**
     * isRegistered
     * @return boolean
     */
    public static function isRegistered()
    {
        if (! empty($_SESSION['session_id'])) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * set method
     * @param mixed $key_or_keys
     * @param mixed $value
     * @throws Error
     * @return boolean
     */
    public static function set($key_or_keys, $value = false)
    {
        if($value !== false) {
            $_SESSION[$key_or_keys] = $value;
        }else{
            if(!is_array($key_or_keys))
                throw new Error('sessionError');
            foreach($key_or_keys as $key=>$value){
                $_SESSION[$key] = $value;
            }
        }
        return true;
    }
    /**
     * get method
     * @param string $key
     * @return array/boolean
     */
    public static function get($key)
    {
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
    }
    /**
     * getSession method
     * @return array
     */
    public static function getSession()
    {
        return $_SESSION;
    }
    /**
     * getSessionId method
     * @return string
     */
    public static function getSessionId()
    {
        return $_SESSION['session_id'];
    }
    /**
     * isExpired method
     * @return boolean
     */
    public static function isExpired()
    {
        return ($_SESSION['session_start'] < self::timeNow()) ? true : false;
    }
    /**
     * renew method
     */
    public static function renew()
    {
        $_SESSION['session_start'] = self::newTime();
    }
    /**
     * timeNow method
     * @return integer
     */
    private static function timeNow()
    {
        $currentHour = date('H');
        $currentMin = date('i');
        $currentSec = date('s');
        $currentMon = date('m');
        $currentDay = date('d');
        $currentYear = date('y');
        return mktime($currentHour, $currentMin, $currentSec, $currentMon, $currentDay, $currentYear);
    }
    /**
     * newTime method
     * @return integer
     */
    private static function newTime()
    {
        $currentHour = date('H');
        $currentMin = date('i');
        $currentSec = date('s');
        $currentMon = date('m');
        $currentDay = date('d');
        $currentYear = date('y');
        return mktime($currentHour, ($currentMin + $_SESSION['session_time']), $currentSec, $currentMon, $currentDay, $currentYear);
    }
    /**
     * forget method
     * @param string $key
     * */
    public static function forget($key)
    {
        unset($_SESSION[$key]);
    }
    /**
     * end method
     */
    public static function end()
    {
        $_SESSION = array();
        session_destroy();
    }
}