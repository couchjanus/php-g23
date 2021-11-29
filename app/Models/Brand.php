<?php 

class Brand0 
{
    public $id;
    public $name;
    public $description;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    private function next(){
        $sql = "SELECT max(id) as maxId FROM brands";
        $stmt = $this->connection->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result->maxId + 1;
    }

    public function save()
    {
        $props = [];
        $class = new ReflectionClass($this);
        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property){
            $propertyName = $property->getName();

            if(isset($this->{$propertyName})){
                $props[] = $propertyName.' = "' . $this->{$propertyName}.'"';
            }
            $setValues = implode(',', $props);
        }
        $sql = '';
        // $setValues = 'name = "'.$this->name.'", '.'description = "'.$this->description.'"';

        if($this->id > 0){
            $sql = "UPDATE brands SET ".$setValues." WHERE id = ".$this->id;
        } else {
            $sql = "INSERT INTO brands SET ".$setValues.", id = ".$this->next();
            // var_dump($sql);
        }

        $stmt = $this->connection->pdo->prepare($sql);
        return $stmt->execute();
    }
}

class Brand extends Entity
{
    public $id;
    public $name;
    public $description;

    protected $tableName = 'brands';
}