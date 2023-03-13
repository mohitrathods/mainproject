<?php

require_once 'Core/Table.php';

class Model_Product extends Model_Core_Table{

    protected $tableName = 'product'; //table name
    protected $primaryKey = 'product_id'; //product_id

    //TOTAL 5 METHODS HERE
    //fetch Row  > return result > pass query
    //not use adapter directly > in all apps, access this model and get data through this model

    //fetchall function fetchall($query)
    //insert funtion pass parameter > data > insert($data[]) pass array on controller
    //update($data[], $wheretopost[]) 
    //

}
?>