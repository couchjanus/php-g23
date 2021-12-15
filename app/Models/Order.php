<?php 
namespace App\Models;

use Core\Entity;

class Order extends Entity
{
    public $id;
    public $user_id;
    public $order_date;
    public $products;
    public $status;
    protected $tableName = 'orders';
}