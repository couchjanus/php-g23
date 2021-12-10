<?php
require_once ROOT."/core/Controller.php";
require_once ROOT."/app/Models/User.php";
require_once ROOT."/app/Models/Role.php";

class AdminController extends Controller
{
    protected static string $layout = 'admin';

    public function __construct(){    
        parent::__construct();
        if(!$this->isAdmin()) $this->response->redirect('/profile');
    }

    protected function isAdmin()
    {
        return ($this->role() === 'admin') ?? false;
    }
}