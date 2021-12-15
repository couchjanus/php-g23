<?php 
namespace App\Models;

use Core\Entity;

class Brand extends Entity
{
    public $id;
    public $name;
    public $description;

    protected $tableName = 'brands';
}