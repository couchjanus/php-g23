<?php
namespace Core;

class Router 
{
    protected $routes = ROUTES;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request !== null ? $request : new Request();
    }

    public function run()
    {
        if (array_key_exists($this->request->uri(), $this->routes)){
            return $this->init($this->routes[$this->request->uri()]);
        } else{
            foreach ($this->routes as $key => $val){
                
                $pattern = '%^'.preg_replace('/{([^\s]+)}/', '(?<$1>[0-9]+)', $key).'$%';
                preg_match($pattern, $this->request->uri(), $matches);
                array_shift($matches);

                if ($matches){
                    $arr = $val;
                    $arr[] = $matches;
                    return $this->init(...$arr);
                }
            }
            return $this->init($this->routes['error']);
        }
    }
  
    private function init($path, $params=[]){
        [$controller, $action] = explode('@', $path);
        $controller = CONTROLLERS.$controller;
        $controller = new $controller();
        $controller->$action($params);
    }
}