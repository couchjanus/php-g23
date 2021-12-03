<?php
require_once ROOT.'/core/Connection.php';
require_once ROOT."/app/Models/Category.php";

class CategoryController
{
    public function __construct(){
        
        // echo "BrandController Constructor";
    }

    public function index(){
        $categories = (new Category())->all();
        render('/admin/categories/index', ['categories' => $categories], 'admin');
    }

    private function fileName($name){
        return  sha1(mt_rand(1, 9999).$name.uniqid()).time();
    }


    private function upload($data){
        if(!empty($data['cover'])){
            $fileName = $this->fileName($data['cover']['name']);
            if(move_uploaded_file($data['cover']['tmp_name'], STORAGE.'/categories/'.$fileName)){
                return "http://".$_SERVER['HTTP_HOST'].'/storage/categories/'.$fileName;
            }

        }
    }

    public function create(){
        if($_POST){
            $category = new Category();
            $category->name = $_POST['name'];
            
            $category->status = isset($_POST['status'])?1:0;

            $category->cover = $this->upload($_FILES);

            if($category->save()){
                $redirect = "http://".$_SERVER['HTTP_HOST'].'/admin/categories';
                header("LOcation: $redirect");
                exit();
            }
        }
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

    public function edit($params){
        extract($params);
        $db = new Connection();
        $sql = "SELECT * FROM categories WHERE id=?";
        $stmt = $db->pdo->prepare($sql);
       
        $stmt->execute([$id]);
        $category = $stmt->fetch();

        if ($_POST){
            $status = $_POST['status'] ? 1:0;
            $data = [$_POST['name'], $status, $id];
    
            $sql = "UPDATE categories SET name=?, status=? WHERE id=?";
            $stmt = $db->pdo->prepare($sql);
    
            if ($stmt->execute($data)){
                $redirect = "http://".$_SERVER['HTTP_HOST'].'/admin/categories';
                header("Location: $redirect");
                exit();
            }
        }
        render('/admin/categories/edit', ['category'=>$category], 'admin');
    }

}

