<!-- all the queries code will be here -->

<?php
require_once 'model/core/adapter.php';

// echo "<pre>";

$link = $_GET['page'].'Fetch'; //get page.fetch > pageFetch : concate > gridFetch > goto gridFetch > show file mentioned 
$productclass = new Product(); //access to class
$productclass->$link();   

class Product {
  
    // fetch items in GRID
    public function gridFetch(){
        
        //query and access to adapter class
        $query = "SELECT * FROM `product` WHERE 1";
        $adaptervar = new adapter();

        $products = $adaptervar->fetchAll($query);

        require_once 'view/product/grid.phtml';


    }


    // add items
    public function addFetch(){
        require_once 'view/product/add.phtml';
    }

    public function insertFetch(){
        //get user input
        $name = $_POST['name'];
        $sku = $_POST['sku'];
        $cost = $_POST['cost'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $color = $_POST['color'];
        $status = $_POST['status'];
        $material = $_POST['material'];
        
        //date time updated at
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");
        // echo $datetime;

        //write query to insert
        $query = "INSERT INTO `product`(`name`,`sku`,`cost`,`price`,`quantity`,`description`,`color`,`status`,`material`,`created_at`)
        VALUES ('$name','$sku','$cost','$price','$quantity','$description','$color','$status','$material','$datetime')";

        //get access to adapter
        $adaptervar = new adapter();

        //result
        $result = $adaptervar->insertData($query);

        header('location:http://localhost/phpproject/product.php?page=grid');
    }

    //DELET FUNCTION
    public function deleteFetch(){
        //get id
        $link = $_GET['id'];

        //write query
        $query = "DELETE FROM `product` WHERE `product_id`=$link";

        //get access to adapter class
        $adaptervar = new adapter();

        //result
        $result = $adaptervar->deleteFun($query);
        header('location:http://localhost/phpproject/product.php?page=grid');
    }

    public function editFetch(){

        $adaptervar = new adapter();
        $link = $_GET['id'];
        // print_r($link);
        $getrow = "SELECT * FROM `product` WHERE `product_id` = $link";
        $resultrow = $adaptervar->fetchRow($getrow);
        // print_r($resultrow);
        require_once 'view/product/edit.phtml';
           
    }   
    public function updateFetch(){

        $adaptervar = new adapter();
        //get id here
        $link = $_GET['id'];

        //get values
        $name = $_POST['name'];
        $sku = $_POST['sku'];
        $cost = $_POST['cost'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $color = $_POST['color'];
        $status = $_POST['status'];
        $material = $_POST['material'];

        //date time updated at
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");
        // echo $datetime;

        //update query and result
        $updatequery = "UPDATE `product` SET `name` = '$name', `sku`='$sku',`cost`='$cost',`price`='$price',`quantity`='$quantity',
        `description` = '$description',`color`='$color',`status`='$status',`material`='$material',`updated_at`='$datetime' WHERE `product_id` = $link";
        $resultquery = $adaptervar->updateFun($updatequery);
        // print_r($updatequery);    
        echo "<br>";
        // print_r($resultquery); // returns 1 as true
        header('location:http://localhost/phpproject/product.php?page=grid');
    }
    
}
?>
