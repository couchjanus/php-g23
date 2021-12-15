<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\{User, Order};


class OrderController extends Controller
{
    protected static string $layout = 'app';

    public function __construct()
    {
        parent::__construct();
        if ($this->userId = $this->request->session()->get('userId')){
            $this->user = (new User)->getWhere(['id' => $this->userId]);

            if($this->user) $this->loggod_in = true;
        }
        
    }

    public function cart()
    {
        if(!$this->user) $this->response->redirect('/login');

        if(strtoupper($_SERVER['REQUEST_METHOD']) != "POST") throw new Exception('Only POST requests are allowed');

        $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
        if(stripos($content_type, 'application/json') === false){ 
            throw new Exception('CONTENT_TYPE must be application/json');
        }else{
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $productsInCart = json_encode($decoded['cart']);

            $order = new Order();
            $sql = "INSERT INTO orders (user_id, products) VALUES (?, ?)";
            $res = $order->insert($sql, [$user->user->id, $productsInCart]);

            if($res){
                $options = [
                    'error' => false,
                    'message' => 'Everything OK'
                ];
                echo json_encode($options);
            }
        }
    }
}