<?php 
namespace Core;

class Session 
{
    private static $instance = null;

    protected function __construct()
    {
        session_start();
    }

    public static function instance()
    {
        if(self::$instance === null){
            self::$instance = new Session;
        }
        return self::$instance;
    }

    public static function get($key){
        return $_SESSION[$key] ?? false;
    }
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }
    public static function unset($key){
        unset($_SESSION[$key]);
    }
    public static function destroy(){
        if(self::$instance === true){
            session_unset();
        }
    }

    public  function replace($key, $value){
        unset($_SESSION[$key]);
        $this->set($key. $value);
    }

    // flash

    public function setFlash($key, $value){
        $_SESSION['flash'][] = [$key => $value];
    }

    public function flash(){
        if (isset($_SESSION['flash'])){
            return count($_SESSION['flash']);
        }
        return 0;
    }

    public function message(){
        $flash = $_SESSION['flash'][0];
        $key = array_key_first($flash);
        $flash = $flash[$key];
        $this->unset('flash');
        return [$key, $flash];
    }

}