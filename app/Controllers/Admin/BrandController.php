<?php

class BrandController
{
    public function __construct(){
        
        // echo "BrandController Constructor";
    }

    public function index(){
        echo "Brands List ";
        // render('/admin/brands/index');
    }

    public function create(){
        echo "Add New Brand";
        // render('/admin/brands/create');
    }

}

