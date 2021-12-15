<?php 
namespace App\Models;

use Core\Entity;

class Role extends Entity
{
    public $id;
    public $name;

    protected $tableName = 'roles';
}