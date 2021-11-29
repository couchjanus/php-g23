<?php
require_once ROOT."/app/Models/Brand.php";

class BrandController
{
    public function __construct(){    
        // echo "BrandController Constructor";
    }

    public function index(){
        $brands = (new Brand())->all();
        render('/admin/brands/index', compact('brands'), 'admin');
    }

    public function create(){
        if($_POST){
            $brand = new Brand();
            $brand->name = $_POST['name'];
            $brand->description = $_POST['description'];
            if($brand->save()){
                $redirect = "http://".$_SERVER['HTTP_HOST'].'/admin/brands';
                header("LOcation: $redirect");
                exit();
            }
        }
        render('/admin/brands/create', [], 'admin');
    }

    public function edit($params){
        extract($params);
        $brand = new Brand();
        if($_POST){
            $brand->name = $_POST['name'];
            $brand->description = $_POST['description'];
            $brand->id = $id;
            if($brand->save()){
                $redirect = "http://".$_SERVER['HTTP_HOST'].'/admin/brands';
                header("Location: $redirect");
                exit();
            }
        }
        $brand = $brand->getById($id);
        render('/admin/brands/edit', compact('brand'), 'admin');
    }

}

