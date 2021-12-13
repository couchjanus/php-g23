<?php

return [
    '' => 'HomeController@index',
    'about' => 'AboutController@index',
    'contact' => 'ContactController',
    'error' => 'ErrorController@index',
    'cart' => 'CartController@index',
    'admin' => 'Admin\DashboardController@index',
    'admin/contact' => 'Admin\ContactController',
    'admin/brands' => 'Admin\BrandController@index',
    'admin/brands/create' => 'Admin\BrandController@create',
    'admin/brands/store' => 'Admin\BrandController@store',
    'admin/brands/edit/{id}' => 'Admin\BrandController@edit',

    'admin/products' => 'Admin\ProductController@index',
    'admin/products/create' => 'Admin\ProductController@create',

    'admin/categories' => 'Admin\CategoryController@index',
    'admin/categories/create' => 'Admin\CategoryController@create',
    'admin/categories/store' => 'Admin\CategoryController@store',

    'admin/categories/edit/{id}' => 'Admin\CategoryController@edit',
    'admin/categories/delete/{id}' => 'Admin\CategoryController@delete',

    'register' => 'RegisterController@index',
    'signup' => 'RegisterController@signup',

    'login' => 'LoginController@index',
    'signin' => 'LoginController@signin',
    'logout' => 'LoginController@logout',
    'profile' => 'ProfileController@index',
    
    'api/categories' => 'HomeController@getCategories',
    'api/products' => 'HomeController@getProducts',
    'api/products/{id}' => 'HomeController@getProductsByCategory',

    'api/cart' => 'OrderController@cart',
    
];