<?php
require_once ROOT."/app/Models/Brand.php";
require_once ROOT."/app/Models/Category.php";
require_once ROOT."/app/Models/Product.php";

class ProductController
{
    public function __construct(){    
        // echo "BrandController Constructor";
    }

    public function index(){
        $products = (new Product())->all();
        render('/admin/products/index', compact('products'), 'admin');
    }

    private function fileName($name){
        return  sha1(mt_rand(1, 9999).$name.uniqid()).time();
    }


    private function upload($data){
        if(!empty($data['cover'])){
            $fileName = $this->fileName($data['cover']['name']);
            if(move_uploaded_file($data['cover']['tmp_name'], STORAGE.'/'.$fileName)){
                return "http://".$_SERVER['HTTP_HOST'].'/storage/'.$fileName;
            }

        }
    }

    public function create(){
        if($_POST){
            $product = new Product();
            $product->name = $_POST['name'];
            $product->description = $_POST['description'];
            $product->price = floatval($_POST['price']);
            $product->badge = isset($_POST['badge'])?intval($_POST['badge']):0;
            $product->category_id = intval($_POST['category_id']);
            $product->brand_id = intval($_POST['brand_id']);
            $product->status = isset($_POST['status'])?1:0;

            $product->cover = $this->upload($_FILES);

            if($product->save()){
                $redirect = "http://".$_SERVER['HTTP_HOST'].'/admin/products';
                header("LOcation: $redirect");
                exit();
            }
        }
        $categories = (new Category())->all();
        $brands = (new Brand())->all();
        $badges = [1=>'new', 2=>'sale', 3=>'action'];
        render('/admin/products/create', compact('brands', 'categories', 'badges'), 'admin');
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

