<?php
class Model_Core_Table{

    public $tableName = null; 
    public $primaryKey = null; 

    public $adapter = null;

    public function setTableName($tableName){
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName(){
        return $this->getTableName();
    }

    public function setPrimaryKey($primaryKey){
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey(){
        return $this->getPrimaryKey();
    }

    public function setAdapter($adapter){
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter(){
        if($this->adapter){
            return $this->adapter;
        }
        $adapter = new adapter();
        $this->getAdapter($adapter);
        return $adapter;
    }

    public function fetchAll(){

    }
}

?>