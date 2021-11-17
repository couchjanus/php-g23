<?php
$address = conf('contacts');

if($_POST){
    $data = [
        'email' => $_POST['email'],
        'country' => $_POST['country'],
        'city' => $_POST['city'],
        'street' => $_POST['street'],
        'mobile' => $_POST['mobile'],
    ];

    $json = json_encode($data);
    $url = CONFIG."/contacts.json";
    file_put_contents($url, $json);
    $redirect = "http://".$_SERVER['HTTP_HOST'].'/contact';
    header("Location: $redirect");
    exit();
}

?>


<form method="POST">
    <label>Email: <input type="email" value="<?=$address['email']?>" name="email"></label><br>
    <label>Street: <input type="text" value="<?=$address['street']?>"  name="street"></label><br>
    <label>City: <input type="text" value="<?=$address['city']?>"  name="city"></label><br>
    <label>Country: <input type="text" value="<?=$address['country']?>"  name="country"></label><br>
    <label>Phone: <input type="text" value="<?=$address['mobile']?>"  name="mobile"></label><br>
    <button type="submit">Save</button>
</form>