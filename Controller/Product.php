<?php
require_once 'Controller/Core/Action.php';
require_once 'Model/Product.php';
class Controller_Product extends Controller_Core_Action{ 

    protected $product = [];
    protected $productId = null;

    protected $model = null;

    public function setProduct($product){
        $this->product = $product;
        return $this;
    }
    
    public function getProduct(){
        return $this->product;
    }
    
    public function setProductId($productId){
        $this->productId = $productId;
        return $this;
    }

    public function getProductId(){
        return $this->productId;
    }

    public function setModel($model){
        $this->model = $model;
        return $this;
    }

    public function getModel(){
        if($this->model){
            return $this->model;
        }
        $model = new Model_Product();
        $this->setModel($model);
        return $model;
    }

    public function gridAction(){
        $this->getModel()->setTableName("product");
        $product = $this->getModel()->fetchAll();
        $this->setProduct($product);

        $this->getTemplate("product/grid.phtml");
    }

    
    public function addAction(){
        $this->getTemplate("product/add.phtml");
        // require_once 'view/product/add.phtml';
    }

    public function insertAction(){
        $request = new Model_Core_Request();
        $products = $request->getPost('product'); 
        
        // print_r($products);
        $name = $products['name'];
        $sku = $products['sku'];
        $cost = $products['cost'];
        $price = $products['price'];
        $quantity = $products['quantity'];
        $description = $products['description'];
        $color = $products['color'];
        $status = $products['status'];
        $material = $products['material'];
        // print_r($_POST['product']);
        
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $query = "INSERT INTO `product`(`name`,`sku`,`cost`,`price`,`quantity`,`description`,`color`,`status`,`material`,`created_at`)
        VALUES ('$name','$sku','$cost','$price','$quantity','$description','$color','$status','$material','$datetime')";

        $adapter = new adapter();

        $products = $adapter->insertData($query);

        $this->redirect("index.php?c=product&a=grid");
    }

    //DELET FUNCTION
    public function deleteAction(){
        //get id
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        $this->setProductId($link);

        $query = "DELETE FROM `product` WHERE `product_id`=$link";

        $adapter = new adapter();
        $products = $adapter->deleteFun($query);

        $this->redirect("index.php?c=product&a=grid");
    }

    public function editAction(){

        $adapter = new adapter();
        // $link = $_GET['id'];
        $request = new Model_Core_Request();
        $link = $request->getParam('id');
        $this->setProductId($link);

        $getrow = "SELECT * FROM `product` WHERE `product_id` = $link";
        $productsrow = $adapter->fetchRow($getrow);
        $this->setProduct($productsrow);
        // print_r($productsrow);

        $this->getTemplate("product/edit.phtml");
    }   
    public function updateAction(){

        $adapter = new adapter();
        
        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        $products = $request->getPost('product');

        $name = $products['name'];
        $sku = $products['sku'];
        $cost = $products['cost'];
        $price = $products['price'];
        $quantity = $products['quantity'];
        $description = $products['description'];
        $color = $products['color'];
        $status = $products['status'];
        $material = $products['material'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $updatequery = "UPDATE `product` SET `name` = '$name', `sku`='$sku',`cost`='$cost',`price`='$price',`quantity`='$quantity',
        `description` = '$description',`color`='$color',`status`='$status',`material`='$material',`updated_at`='$datetime' WHERE `product_id` = $link";
        $resultquery = $adapter->updateFun($updatequery);

        $this->redirect("index.php?c=product&a=grid");
    }

}
?>
