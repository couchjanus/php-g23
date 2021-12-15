<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\{User, Role};
use Core\AuthInterface;


class ProfileController extends Controller implements AuthInterface
{
    protected static string $layout = 'app';
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = (new User)->getWhere(['id' => $this->request->session()->get('userId')]) ?? null;

        $this->isGranted();
  
    }

    public function index()
    {
        // var_dump($this->user);
        // exit();
        $this->response->render('profile/index');
    }

    public function isGranted(string $role = 'customer'):bool{
        if (!$this->user) $this->response->redirect('/login');
        return true;
    }
}