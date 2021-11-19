
<h1>Contact Page</h1>

<?php if (isset($address)):?>

<ul>
    <li><?=$address['street'];?></li>
    <li><?=$address['city'];?></li>
    <li><?=$address['country'];?></li>
    <li><?=$address['mobile'];?></li>
    <li><?=$address['email'];?></li>
</ul>

<?php endif;?>


<?php if (isset($messages)):?>
    <?php foreach ($messages as $row):?>
        <li class="mb-2">
            Customer <?=$row['name']?> wrote this:
            <?=$row['message']?> 
            at: <?=date("d-m-Y", strtotime($row['created_at']))?>
        </li>
        <?php endforeach?>
<?php endif;?>  
<hr>
<br>
<form method="post">
    <elabel>Name: <input name="name"></elabel><br>
    <label>Email: <input name="email" type="email"></label><br>
    <label>Message: <input name="message"></label><br>
    <input type="submit"><br>
</form>
<br>