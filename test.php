<?php

// $url = 'admin/categories/edit/7777';
$url = 'admin/brands/edit/555';
$key = 'admin/brands/edit/{id}';

// $pattern = '%^admin/categories/edit/(?<id>[0-9]+)$%';
// $pattern = '%^[^\s]+/(?<id>[0-9]+)$%';
// $result = preg_match($pattern, $url, $matches);

$pattern = '%^'.preg_replace('/{([^\s]+)}/', '(?<$1>[0-9]+)', $key).'$%';

$result = preg_match($pattern, $url, $matches);

var_dump($result, $matches);