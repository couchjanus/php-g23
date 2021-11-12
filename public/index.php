


<ul>
    <li><a href="/">Home</a> </li>
    <li><a href="/about">About</a> </li>
    <li><a href="/contact">Contact</a> </li>
</ul>
<?php

// 
/**
 * documentation
 */

const A = 'Hello';
switch($_SERVER['REQUEST_URI']){
    case '/':
        echo '<h1>Home Page</h1>';
        
        $a = "World";

        $x = 10;
        $y = 10.7;

        echo '<h2>$x + $y = '.$x + $y.'</h2>';
        echo "<h2>$x + $y = ".$x + $y.'</h2>';

        print('<h2>Hello print</h2>');
        echo A.$a; 

        var_dump(PHP_INT_MAX);

        print_r(__DIR__);
        print_r(__dir__);


        $list = [
            "key" => "value"
        ];

        var_dump($list);

        // phpinfo();

        var_dump($_SERVER['REQUEST_URI']);
        break;
    case '/about': 
        echo '<h1>About Page</h1>';
        var_dump($_SERVER['REQUEST_URI']);
        break;

    case '/contact':
        echo '<h1>Contact Page</h1>';
        var_dump($_SERVER['REQUEST_URI']);
        break;
}





