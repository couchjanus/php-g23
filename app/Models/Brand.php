<?php 

class Brand extends Entity
{
    public $id;
    public $name;
    public $description;

    protected $tableName = 'brands';
}