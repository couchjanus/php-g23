<?php
namespace Core;

use Core\Session;
use Core\Request;
use Core\Router;

class App 
{
    public function __construct()
    {
        Session::instance();
    }

    public function run()
    {
        (new Router(new Request()))->run();
    }
}