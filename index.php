<?php
require_once 'Controller/Core/Front.php';

class Index {
    public static function init(){
        $front = new Controller_Core_Front();
        $front->init();
    }
}

Index::init(); //call static fun
?>




<!-- //sada class mate object banavi ne call

//have 2 parameters pass thase a ma grid pass c ma product pass 
//have  category evu url ma pass ny thay khali c pass thase
//product.php, customer.php e badhay controller chhe
//practice is index.php only index file will be called -->
