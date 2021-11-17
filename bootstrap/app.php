<?php
define('ROOT', dirname(__DIR__));

// echo ROOT;
const CONTROLLERS = ROOT.'/app/Controllers';
const VIEWS = ROOT.'/app/Views';
const CONFIG = ROOT.'/config';

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

function render($view, $params=null){
    sendHeaders();
    ob_start();
    $content = view($view, $params);
    require_once VIEWS.'/layouts/app.php';
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

$routes = require_once CONFIG.'/routes.php';

$result = false;

function getController($path){
    $segments = explode('\\', $path);
    $controller = array_pop($segments);
    $segments = array_pop($segments);
    $segments = $segments ? "/${segments}" : '';
    return [$segments, $controller];
}

foreach ($routes as $route => $path){
    if ($route == uri()){
        list($segment, $controller) = getController($path);
        $controllerPath = CONTROLLERS."${segment}/${controller}.php";
        if(file_exists($controllerPath)){
            include_once($controllerPath);
            $result = true;
            break;
        }
    }
}

if(!$result){
    sendHeaders(404);
    echo "<h1>404: OOPS, Page not found!</h1>";
}
