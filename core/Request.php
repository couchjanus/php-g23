<?php 
namespace Core;

class Request 
{
    private $request;

    public function __construct(){
        $this->request = $this->prepareRequest($_REQUEST, $_FILES);
    }

    private function prepareRequest(array $request, array $files): array
    {
        $request = $this->cleanInput($request);
        return array_merge($files, $request);
    }

    private function cleanInput($data)
    {
        if (is_array($data)) {
            $cleaned = [];
            foreach ($data as $key => $value) {
                $cleaned[$key] = $this->cleanInput($value);
            }
            return $cleaned;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }

    public function getRequest(){
        return $this->require;
    }
    public function __get($name){
        if(isset($this->request[$name])) return $this->request[$name];
    }

    public function uri(){
        $uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        return trim($uri, '/') ?? '';
    }

    public function session()
    {
        return Session::instance();
    }
}