<?php

class Controller_Product {
    public function gridAction(){
        //query and access to adapter class
        $query = "SELECT * FROM `product` WHERE 1";
        $adaptervar = new adapter();
        $products = $adaptervar->fetchAll($query);

        require_once 'view/product/grid.phtml';
    }
}
?>

<!-- 
//sada class mate object banavi ne call

//have 2 parameters pass thase a ma grid pass c ma product pass 
//have  category evu url ma pass ny thay khali c pass thase
//product.php, customer.php e badhay controller chhe
//practice is index.php only index file will be called
//Product in c -->