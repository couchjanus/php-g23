<?php
require_once ROOT.'/core/Controller.php';

class CartController extends Controller
{
    protected static string $layout = 'app';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->response->render('home/cart');
    }
}