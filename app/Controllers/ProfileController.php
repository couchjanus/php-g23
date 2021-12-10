<?php

require_once ROOT."/app/Models/User.php";
require_once ROOT."/app/Models/Role.php";
require_once ROOT.'/core/Controller.php';

class ProfileController extends Controller
{
    protected static string $layout = 'app';
   

    public function __construct()
    {
        parent::__construct();
        //
    }

    public function index()
    {
        $this->response->render('profile/index');
    }
}