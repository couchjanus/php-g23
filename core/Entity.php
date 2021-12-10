<?php 
require_once ROOT.'/core/Connection.php';

abstract class Entity 
{
    protected $tabeName;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    private function next(){
        $sql = "SELECT max(id) as maxId FROM ".$this->tableName;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result->maxId + 1;
    }

    public function all(){
        $sql = "SELECT * FROM ".$this->tableName;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function runSql($sql){
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id){
        $sql = "SELECT * FROM " . $this->tableName . " WHERE id = " . $id;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getWhere($options = []){
        $sql = '';
        $where = '';
        $whereConditions = [];
        if(!empty($options)){
            foreach ($options as $key => $value){
                $whereConditions[] = '`'.$key.'` = "'.$value.'"';
            }
            $where = " WHERE ".implode(' AND ', $whereConditions);
        }
        $sql = "SELECT * FROM " . $this->tableName . $where;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
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
      
        if($this->id > 0){
            $sql = "UPDATE ".$this->tableName." SET ".$setValues." WHERE id = ".$this->id;
        } else {
            $sql = "INSERT INTO ".$this->tableName." SET ".$setValues.", id = ".$this->next();
        }

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute();
    }
}