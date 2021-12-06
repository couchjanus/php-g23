<?php
require_once ROOT."/app/Models/Brand.php";
require_once ROOT."/core/Controller.php";

class BrandController extends Controller
{
    protected static string $layout = 'admin';

    public function __construct(){    
        parent::__construct();
        // 
    }

    public function index(){
        $brands = (new Brand())->all();
        $this->response->render('/admin/brands/index', compact('brands'));
    }

    public function create(){
        $this->response->render('/admin/brands/create', []);
    }

    public function store(){
        $brand = new Brand();
        $brand->name = $this->request->name;
        $brand->description = $this->request->description;
        if($brand->save()){
            $this->response->redirect('/admin/brands');
        }
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

