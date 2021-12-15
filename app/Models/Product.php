<?php 
namespace App\Models;

use Core\Entity;

class Product extends Entity
{
    public $id;
    public $name;
    public $status;
    public $description;
    public $badge;
    public $price;
    public $cover;
    public $category_id;
    public $brand_id;

    protected $tableName = 'products';
}
