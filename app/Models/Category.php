<?php 


class Category extends Entity
{
    public $id;
    public $name;
    public $status;

    protected $tableName = 'categories';
}
