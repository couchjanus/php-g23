<?php
namespace App\Controllers\Admin;

use Core\Controller;
use App\Models\{User, Role};
use Core\AuthInterface;

class AdminController extends Controller implements AuthInterface
{
    protected static string $layout = 'admin';

    public function __construct(){    
        parent::__construct();
        if(!$this->isGranted('admin')) $this->response->redirect('/profile');
    }

    public function isGranted(string $role):bool{
        return ($this->role() === $role) ?? false;
    }
}