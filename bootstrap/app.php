<?php
define('ROOT', dirname(__DIR__));
const CONTROLLERS = ROOT.'/app/Controllers';
const VIEWS = ROOT.'/app/Views';
const CONFIG = ROOT.'/config';
define('ROUTES', require_once CONFIG.'/routes.php');

define('STORAGE', $_SERVER['DOCUMENT_ROOT'].'/storage');

function conf($mix){
    $url = CONFIG."/".$mix.".json";
    $json = file_get_contents($url);
    return json_decode($json, True);
}


require_once ROOT.'/core/Entity.php';
require_once ROOT.'/core/Request.php';
require_once ROOT.'/core/Router.php';
require_once ROOT.'/core/Session.php';
Session::instance();
// Session::set('hello', 'world');
// $request = new Request();
// print_r(Session::get('hello'));
$router = new Router(new Request());
$router->run();

