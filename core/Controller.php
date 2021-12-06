<?php 
require_once ROOT.'/core/Response.php';

class Controller 
{
    protected static string $layout;
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request = null)
    {
        $this->request = $request ?? new Request();
        $this->response = new Response(static::$layout);
    }

}