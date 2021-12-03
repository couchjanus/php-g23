<?php 


class Category extends Entity
{
    public $id;
    public $name;
    public $status;
    public $cover;

    protected $tableName = 'categories';
}
