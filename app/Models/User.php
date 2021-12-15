<?php 
namespace App\Models;

use Core\Entity;

class User extends Entity
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $status;
    public $first_name;
    public $last_name;
    public $phone_number;
    protected $tableName = 'users';

}