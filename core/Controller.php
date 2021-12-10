<?php 
require_once ROOT.'/core/Response.php';

class Controller 
{
    protected static string $layout;
    protected Request $request;
    protected Response $response;
    protected $user;

    public function __construct(Request $request = null)
    {
        $this->request = $request ?? new Request();
        $this->response = new Response(static::$layout);

        $this->user = (new User)->getWhere(['id' => $this->request->session()->get('userId')]) ?? null;
    }
    public function auth()
    {
        return $this->user? true:false;
    }
    public function role()
    {
        if ($this->auth()){
            $role = (new Role)->getWhere(['id' => $this->user->role_id]);
            return $role->name;
        }
    }
}