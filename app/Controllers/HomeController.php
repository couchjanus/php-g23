<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\{Category, Product};


class HomeController extends Controller
{
    protected static string $layout = 'app';

    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->response->render('/home/index');
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

