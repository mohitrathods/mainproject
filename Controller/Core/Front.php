<?php 
class Controller_Core_Front{
    public function callController(){
        echo "controller core front";
        
        require_once 'Controller/Product.php';
        $product = new Product_controller();
        $product->init();
    }
}
?>