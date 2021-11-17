<?php
$address = conf('contacts');
// var_dump($address);

// render('/contact/index', ['address' => $address]);
render('/contact/index', ['address' => $address]);