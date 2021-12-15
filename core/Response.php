<?php 
namespace Core;

class Response 
{
    public array $headers;
    private string $content;
    private string $version;
    private int $statusCode;
    private string $statusText;
    private string $charset;

    protected string $layout;


    private array $statusTexts = [
        200 => 'OK',
        302 => 'Found',
        400 => 'Bad Request',
        401 => 'Unautorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error'
    ];

    public function __construct(string $layout, int $status = 200, array $headers = []){
        $this->headers = $headers;
        $this->statusCode = $status;
        $this->statusText = $this->statusTexts[$status];
        $this->version = '1.0';
        $this->charset = 'UTF-8';

        $this->layout = $layout;

        ob_start();
        require_once VIEWS."/layouts/$this->layout.php";
        $this->content = ob_get_clean();
    }

    private function send():self
    {
        $this->sendHeaders();
        $this->sendContent();
        $this->flushBuffer();
        return $this;
    }

    private function sendHeaders():self{
        if(headers_sent()){
            return $this;
        } 
        header(sprintf('HTTP/%s %s $s', $this->version, $this->statusCode, $this->statusText), true, $this->statusCode);

        foreach($this->headers as $name => $value){
            header($name.':'.$value, true, $this->statusCode);
        }

        if(!array_key_exists('Content-Type', $this->headers)){
            header('Content-Type: '.'text/html; charset='.$this->charset);
        }
        return $this;
    }
    private function sendContent():self{
        echo $this->content;
        return $this;
    }

    private function setContent(string $content = ''):self{
        $this->content = $content;
        return $this;
    }


    private function flushBuffer():void{
        flush();
    }

    private function rendered(string $view, array $params=null):string{
        foreach($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        
        require_once VIEWS."/${view}.php";
        $content = ob_get_clean();

        return str_replace('{{content}}', $content, $this->content);
    }
    
    public function render($view, $params=[]){
       $rendered = $this->rendered($view, $params);
       $this->setContent($rendered);
       $this->send();
    }

    public function redirect(string $location = ''){
        header("Location: http://".$_SERVER['HTTP_HOST'] . $location);
        exit();
    }
}