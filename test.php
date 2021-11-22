<?php

class MyClass
{
    public $prop;
    protected $protProp;
    private $privateProp;
}

$my = new MyClass;
$my->prop = 77;
// $my->protProp = "It's protected";
// $my->privateProp = "It's private";
var_dump($my);
$my1 = new MyClass;

$my1->prop = 775;
if ($my == $my1){
    echo "It's eqw";
}else{
    echo "It's not eqw";
}
