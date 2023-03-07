<?php 
require_once 'Model/Core/adapter.php';
require_once 'Model/Core/Request.php';


class Controller_Core_Front{
    
    public function init(){

        $request = new Model_Core_Request();//add in action and extend class 
        $requestName = $request->getControllerName();
        print_r($requestName);
        // die();

        require_once 'Controller/Product.php';
        $product = new Controller_Product();
        $product->gridAction();
        print_r($product);
    }
}
?>