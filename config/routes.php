<?php

return [
    '' => 'HomeController@index',
    'about' => 'AboutController@index',
    'contact' => 'ContactController',

    'admin' => 'Admin\DashboardController@index',
    'admin/contact' => 'Admin\ContactController',
    'admin/brands' => 'Admin\BrandController@index',
    'admin/brands/create' => 'Admin\BrandController@create',

    'admin/categories' => 'Admin\CategoryController@index',
    'admin/categories/create' => 'Admin\CategoryController@create',
    'admin/categories/store' => 'Admin\CategoryController@store',
  
];