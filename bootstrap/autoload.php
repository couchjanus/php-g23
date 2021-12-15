<?php 

function conf($mix){
    $url = CONFIG."/".$mix.".json";
    $json = file_get_contents($url);
    return json_decode($json, True);
}

function load($file){
    if(is_file($file)) include_once $file;
}

spl_autoload_register(function($class){
    $parts = explode('\\', $class);
    $classDirs = [
        '/core/',
        '/app/Controllers/',
        '/app/Models/',
        '/app/Controllers/Admin/'
    ];

    foreach($classDirs as $dir){
        load(ROOT.$dir.end($parts).'.php');
    }

});