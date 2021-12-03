<?php
require_once ROOT.'/app/Models/Category.php';
require_once ROOT.'/app/Models/Product.php';

class HomeController
{
    public function __construct(){
        // render('/home/index');
    }
    public function index(){
        render('/home/index');
    }

    public function getCategories()
    {
        $categories = (new Category())->all();
        echo json_encode($categories);
    }

    public function getProducts()
    {
        $products = (new Product())->all();
        echo json_encode($products);
    }

    public function getProductsByCategory($params)
    {
        extract($params);
        $sql = "SELECT * FROM products WHERE products.category_id=$id";
        $products = (new Product())->runSql($sql);
        echo json_encode($products);
    }
}

