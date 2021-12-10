<?php

require_once ROOT."/app/Models/User.php";

require_once ROOT.'/core/Controller.php';

class RegisterController extends Controller
{
    protected static string $layout = 'app';
    private array $costs = [
        'cost' => 12,
    ];

    public function __construct(){
        parent::__construct();
        // 
    }

    public function index(){
        
        $this->response->render('auth/register');
    }

    public function signup()
    {
        if ($this->is_valid_password($this->request->password, $this->request->confirmpassword)){
            $user = new User();
            list($name, $domain) = explode('@', $this->request->email);
            $user->name = ucwords($name);
            $user->email = $this->request->email;
            $user->first_name = $this->request->first_name;
            $user->last_name = $this->request->last_name;
            $user->phone_number = $this->request->phone_number;
            $hash = password_hash($this->request->password, PASSWORD_BCRYPT, $this->costs);

            $user->password = $hash;
            
            if($user->save()){
                $this->request->session()->setFlash('success','User registred duccessfullu');
                $this->response->redirect('/login');
            }else{
                $this->request->session()->setFlash('danger','Some fields not correct');
                $this->response->redirect('/register');
            }

        }else{
            $this->request->session()->setFlash('danger','Your passwords do not match. Please type correfully!');
            $this->response->redirect('/register');
        }    
            
    }

    private function is_valid_password($password, $confirmpassword)
    {
        if($password != $confirmpassword) return false;
        return true;
    }
}

