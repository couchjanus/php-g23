<?php
define('ROOT', dirname(__DIR__));
const CONTROLLERS = ROOT.'/app/Controllers';
const VIEWS = ROOT.'/app/Views';
const CONFIG = ROOT.'/config';
define('ROUTES', require_once CONFIG.'/routes.php');

define('STORAGE', $_SERVER['DOCUMENT_ROOT'].'/storage');

function uri(){
    $uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    return trim($uri, '/') ?? '';
}

function sendHeaders($status=200, $headers=[]){
    $statusTexts = [
        200 => 'OK',
        302 => 'Found',
        400 => 'Bad Request',
        401 => 'Unautorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error'
    ];

    $statusText = $statusTexts[$status];
    $version = '1.1';
    $charset = 'UTF-8';

    if(headers_sent()) {
        return;
    }
    header("HTTP/$version $status $statusText");

    if(!array_key_exists('Content-Type', $headers)){
        header('Content-Type: '. 'text/html; charset='.$charset);
    }

    foreach($headers as $name => $value){
        header($name.': '.$value, true, $status);
    }
}

function render($view, $params=null, $layout='app'){
    sendHeaders();
    ob_start();
    $content = view($view, $params);
    require_once VIEWS."/layouts/${layout}.php";
    echo str_replace('{{content}}', $content, ob_get_clean());
}

function view($view, $params){
    if($params){
        extract($params);
    }
    ob_start();
    include_once VIEWS."/$view.php";
    return ob_get_clean();
}

function conf($mix){
    $url = CONFIG."/".$mix.".json";
    $json = file_get_contents($url);
    return json_decode($json, True);
}


require_once ROOT.'/core/Entity.php';

// $brand = new Brand();
// $brand->id = 2;
// $brand->name = "Foo brand";
// $brand->description = "New Foo brand desxription";
// $brand->save();
require_once ROOT.'/core/Router.php';

$router = new Router();
$router->run();

