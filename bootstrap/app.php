<?php
define('ROOT', dirname(__DIR__));

// echo ROOT;
const CONTROLLERS = ROOT.'/app/Controllers';
const VIEWS = ROOT.'/app/Views';

function uri(){
    $uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    return trim($uri, '/') ?? '';
}

function render($view){
    ob_start();
    $content = view($view);
    require_once VIEWS.'/layouts/app.php';
    echo str_replace('{{content}}', $content, ob_get_clean());
}

function view($view){
    ob_start();
    include_once VIEWS."/$view.php";
    return ob_get_clean();
}


switch(uri()){
    case '':
        require_once CONTROLLERS.'/HomeController.php';
        break;
    case 'about': 
        require_once CONTROLLERS.'/AboutController.php';
        break;

    case 'contact':
        require_once CONTROLLERS.'/ContactController.php';
        break;
}
