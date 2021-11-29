<?php

return [
    '' => 'HomeController@index',
    'about' => 'AboutController@index',
    'contact' => 'ContactController',
    'error' => 'ErrorController@index',
    
    'admin' => 'Admin\DashboardController@index',
    'admin/contact' => 'Admin\ContactController',
    'admin/brands' => 'Admin\BrandController@index',
    'admin/brands/create' => 'Admin\BrandController@create',
    'admin/brands/edit/{id}' => 'Admin\BrandController@edit',

    'admin/categories' => 'Admin\CategoryController@index',
    'admin/categories/create' => 'Admin\CategoryController@create',
    'admin/categories/store' => 'Admin\CategoryController@store',

    'admin/categories/edit/{id}' => 'Admin\CategoryController@edit',
    'admin/categories/delete/{id}' => 'Admin\CategoryController@delete',
  
];