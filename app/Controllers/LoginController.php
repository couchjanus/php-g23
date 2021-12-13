<?php

require_once ROOT."/app/Models/User.php";
require_once ROOT."/app/Models/Role.php";
require_once ROOT.'/core/Controller.php';

class LoginController extends Controller
{
    protected static string $layout = 'app';

    private $cookie_prefix;
    private $logged_in;
    private $userId;

    public function __construct()
    {
        parent::__construct();
        if ($this->userId = $this->request->session()->get('userId')){
            $this->user = (new User)->getWhere(['id' => $this->userId]);

            if($this->user) $this->loggod_in = true;
        }
        
    }

    public function index() 
    {
        if ($this->logged_in) $this->response->render('profile/index');

        $this->response->render('auth/login');
    }

    private function checkUser($email, $password){
        $user = (new User)->getWhere(['email' => $email]);
        if (!$user) return false;
        else {
            if (password_verify($password, $user->password)){
                return $user->id;
            }else return false;
        }
    }

    public function signin(){
        $this->userId = $this->checkUser($this->request->email, $this->request->password);
        if ($this->userId === false){
            $this->request->session()->set('error', "Something went wrong while logging in site");
            $this->response->redirect('/login');
        }else{
            $this->user = (new User)->getWhere(['id' => $this->userId]);
            $this->logged_in = true;
            $this->request->session()->setFlash('success', "You have logged in successfully");
            $this->request->session()->set('userId', $this->user->id);
            $this->request->session()->set('Logged', $this->logged_in);
            setcookie($this->cookie_prefix.'ID', $this->user->id);
            setcookie($this->cookie_prefix.'Loggrd', $this->logged_in);
            $this->response->redirect('/profile');
        }
    }

    public function logout(){
        if (isset($_COOKIE[$this->cookie_prefix.'ID'])){
            setcookie($this->cookie_prefix.'ID', '', time() - 3600);
            setcookie($this->cookie_prefix.'Loggrd', '', time() - 3600);
        }
        $this->request->session()->destroy();
        $this->loggod_in = false;
        $this->response->redirect('/');
    }
}