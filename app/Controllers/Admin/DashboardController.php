<?php
require_once CONTROLLERS."/Admin/AdminController.php";

class DashboardController extends AdminController
{
    // protected static string $layout = 'admin';

    public function __construct(){    
        parent::__construct();
        // 
    }

    public function index()
    {
        $this->response->render('admin/index', ['title'=>"Admin Dashboard"]);
    }
}