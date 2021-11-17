
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