<?php
require_once ROOT.'/core/Connection.php';
require_once ROOT."/app/Models/Category.php";
require_once ROOT.'/core/Upload.php';
require_once ROOT.'/core/Controller.php';

class CategoryController extends Controller
{
    use Upload;

    public function __construct(){
        
        // echo "BrandController Constructor";
    }

    public function index(){
        $categories = (new Category())->all();
        render('/admin/categories/index', ['categories' => $categories], 'admin');
    }


    public function create(){
       
        $this->response->render('/admin/categories/create', []);
    }

    public function store(){
        
            $category = new Category();
            $category->name = $this->request->name;
            
            $category->status = isset($this->request->status)?1:0;

            $category->cover = $this->upload($this->request->cover);

            if($category->save()){
                $this->response->redirect('/admin/categories');
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

