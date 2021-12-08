<?php

require_once ROOT."/app/Models/User.php";
require_once ROOT."/app/Models/Role.php";
require_once ROOT.'/core/Controller.php';

class UserController extends Controller
{
    protected static string $layout = 'admin';
    private array $costs = [
        'cost' => 12,
    ];

    public function __construct(){
        parent::__construct();
        // 
    }

    public function index(){
        $users = (new User())->all();
        $this->response->render('/admin/users/index', ['users' => $users]);
    }


    public function create(){
       
        $this->response->render('/admin/users/create', []);
    }

    public function store(){
        
            $user = new User();
            $user->name = $this->request->name;
            $user->email = $this->request->email;

            $hash = password_hash($this->request->password, PASSWORD_BCRYPT, $this->costs);

            $user->password = $hash;
            $user->role_id = $this->request->role_id;
            
            if($user->save()){
                $this->response->redirect('/admin/users');
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

