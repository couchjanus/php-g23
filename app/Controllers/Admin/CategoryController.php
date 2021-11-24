<?php
require_once ROOT.'/core/Connection.php';

class CategoryController
{
    public function __construct(){
        
        // echo "BrandController Constructor";
    }

    public function index(){
        $db = new Connection();
        $sql = "SELECT * FROM categories";
        $stmt = $db->pdo->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        // var_dump($categories);
        
        render('/admin/categories/index', ['categories' => $categories], 'admin');
    }

    public function create(){
        render('/admin/categories/create', [], 'admin');
    }

    public function store(){
        $db = new Connection();
        $status = $_POST['status'] ? 1:0;
        $data = [$_POST['name'], $status];

        $sql = "INSERT INTO categories (name, status) VALUES (?, ?)";
        $stmt = $db->pdo->prepare($sql);

        if ($stmt->execute($data)){
            $redirect = "http://".$_SERVER['HTTP_HOST'].'/admin/categories';
            header("Location: $redirect");
        }
    }

}

