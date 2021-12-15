<?php 
namespace App\Models;

use Core\Entity;

class Category extends Entity
{
    public $id;
    public $name;
    public $status;
    public $cover;

    protected $tableName = 'categories';
}
