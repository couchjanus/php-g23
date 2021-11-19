<?php
// phpinfo();

// $link = mysqli_init();
// var_dump($link);
// $con = mysqli_connect('localhost', 'root', '');
// if(!$con){
//    echo mysqli_connect_errno(); 
//    echo mysqli_connect_error(); 
//    exit;
// }
// $sql = "SET NAMES utf8mb4; DROP DATABASE IF EXISTS peculiar; DROP SCHEMA IF EXISTS peculiar; CREATE SCHEMA peculiar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";

// $sql = <<<EOT
//     SET NAMES utf8mb4; 
//     DROP DATABASE IF EXISTS peculiar; 
//     DROP SCHEMA IF EXISTS peculiar; 
//     CREATE SCHEMA peculiar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
// EOT;


$con = mysqli_connect('localhost', 'root', '', 'peculiar');
if(!$con){
   echo mysqli_connect_errno(); 
   echo mysqli_connect_error(); 
   exit;
}

// $sql = <<<EOT
//     CREATE TABLE guestbook (
//         id int NOT NULL AUTO_INCREMENT,
//         name varchar(25) NOT NULL,
//         email varchar(255) NOT NULL,
//         message text NOT NULL,
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//         PRIMARY KEY (id)
//     );
// EOT;

// $sql = <<<EOT
//     INSERT INTO guestbook (name, email, message)
//     VALUES ("Fat Cat", "cat@my.com", "Hello Cats!");
// EOT;


// $sql = "SELECT * FROM guestbook";

$sql = "SELECT * FROM guestbook WHERE id=2";
$result = mysqli_query($con, $sql);
if($result){
    // var_dump($result);
    $items = mysqli_fetch_all($result);
    var_dump($items);
}else{
    echo "Error ".mysqli_error();
}
// var_dump($con);
mysqli_close($con);