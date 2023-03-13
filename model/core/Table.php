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
        return $this->tableName;
    }

    public function setPrimaryKey($primaryKey){
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey(){
        return $this->tableName;
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
        $this->adapter = $adapter;
        return $adapter;
    }

    public function fetchAll(){
        $tableName = $this->getTableName();

        $query = "SELECT * FROM `$tableName` WHERE 1";
        return $this->getAdapter()->fetchAll($query);
    }
}

?>