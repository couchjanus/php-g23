<?php
class ContactController
{
    public function __construct()
    {

        $address = conf('contacts');

        $con = mysqli_connect('localhost', 'root', '', 'peculiar');

        if($_POST){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $message= mysqli_real_escape_string($con, $_POST['message']);
        $sql = <<<EOT
            INSERT INTO guestbook (name, email, message)
            VALUES ('$name', '$email', '$message');
        EOT;

        mysqli_query($con, $sql);

        }

        $sql = "SELECT * FROM guestbook";
        $result = mysqli_query($con, $sql);
        if($result){
            $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }else{
            echo "Error ".mysqli_error();
        }

        // render('/contact/index', ['address' => $address]);
        render('/contact/index', ['address' => $address, 'messages'=>$items]);

    }
}