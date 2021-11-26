<?php

class Router 
{
    protected $routes = ROUTES;

    public function run()
    {
        if (array_key_exists(uri(), $this->routes)){
            return $this->init(...$this->getController($this->routes[uri()]));
        } else{
            foreach ($this->routes as $key => $val){
                
                $pattern = '%^'.preg_replace('/{([^\s]+)}/', '(?<$1>[0-9]+)', $key).'$%';
                preg_match($pattern, uri(), $matches);
                array_shift($matches);

                if ($matches){
                    $arr = $this->getController($val);
                    $arr[] = $matches;
                    return $this->init(...$arr);
                }
            }
            return $this->init(...$this->getController($this->routes['error']));
        }
    }
  
    private function getController($path){
        $segments = explode('\\', $path);
        $segment = array_pop($segments);
        list($controller, $method) = explode('@', $segment);
        $prefix = DIRECTORY_SEPARATOR;
        foreach ($segments as $segment) {
            $prefix .= $segment.DIRECTORY_SEPARATOR;
        }
        return [$prefix, $controller, $method];
    }

    private function init($controllerPath, $controller, $method, $params=[]){
        $controllerPath = CONTROLLERS.$controllerPath.$controller.".php";
        if(file_exists($controllerPath)){ 
            include_once($controllerPath);
            $controller = new $controller();
            $controller->$method($params);
        }
    }
}