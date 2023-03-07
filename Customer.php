<?php 
require_once 'model/core/adapter.php';

//pages
$link = $_GET['page'].'Fun';
$Customer = new Customer();
$Customer->$link(); //pass link to class

class Customer {
    
    //get data from db and show page
    public function gridFun(){
        $adapter = new adapter();
        $query =  "SELECT * FROM `customer` WHERE 1";
        $result = $adapter->fetchAll($query);

        require_once 'view/customer/grid.phtml';
    }

    //add data and show page
    public function addFun(){
        require_once 'view/customer/add.phtml';
    }

    public function insertFun(){
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $mobile = $_POST['mobile'];
        $status = $_POST['status'];
        
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $adapter = new adapter();
        $query = "INSERT INTO `customer`(`first_name`,`last_name`,`email`,`gender`,`mobile`,`status`,`created_at`)
        VALUES ('$firstname','$lastname','$email','$gender','$mobile','$status','$datetime')";
        $result = $adapter->insertData($query);
        print_r($result);
        header('location:Customer.php?page=grid');
    }

    //edit and update
    public function editFun(){

        $link = $_GET['id'];
        $adapter = new adapter();
        $query = "SELECT * FROM `customer` WHERE `customer_id` = $link";
        $result = $adapter->fetchRow($query);

        require_once 'view/customer/edit.phtml';
    }

    public function updateFun(){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $mobile = $_POST['mobile'];
        $status = $_POST['status'];
        
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $link = $_GET['id'];

        $query = "UPDATE `customer` SET `first_name`='$firstname',`last_name`='$lastname',`email`='$email',`gender`='$gender',`mobile`='$mobile',`status`='$status',`updated_at`='$datetime'
        WHERE `customer_id` = $link";

        $adapter = new adapter();
        $result = $adapter->updateFun($query);

        header('location:Customer.php?page=grid');
    }

    public function deleteFun(){
        $link = $_GET['id'];

        $adapter = new adapter();

        $query = "DELETE FROM `customer` WHERE `customer_id` = $link";
        $adapter->deleteFun($query);

        header('location:Customer.php?page=grid');

    }
}
?>