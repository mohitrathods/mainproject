<?php 
require_once 'model/core/adapter.php';

//link setup
$link = $_GET['page'].'Fun';
$Vendor = new Vendor();
$Vendor->$link();

class Vendor{

    // fetch and show the data
    public function gridFun(){

        $adapter = new adapter();
        $query = "SELECT * FROM `vendor` WHERE 1";
        $result =  $adapter->fetchAll($query);

        require_once 'view/vendor/grid.phtml';
    }

    //insert data
    public function addFun(){
        require_once 'view/vendor/add.phtml';
    }

    public function insertFun(){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $mobile = $_POST['firstname'];
        $status = $_POST['status'];
        $company = $_POST['company'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $adapter = new adapter();
        $query = "INSERT INTO `vendor`(`first_name`,`last_name`,`email`,`gender`,`mobile`,`status`,`company`,`created_at`)
        VALUES('$firstname','$lastname','$email','$gender','$mobile','$status','$company','$datetime')";
        $result = $adapter->insertData($query);

        header('location:Vendor.php?page=grid');
    }

    //FETCH THE ROW AND EDIT THE DATA
    public function editFun(){
        $link = $_GET['id'];
        $adapter = new adapter;
        $query = "SELECT * FROM `vendor` WHERE `vendor_id` = $link";
        $result = $adapter->fetchRow($query);

        require_once 'view/vendor/edit.phtml';
    }

    public function updateFun(){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $mobile = $_POST['mobile'];
        $status = $_POST['status'];
        $company = $_POST['company'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $link =  $_GET['id'];

        $adapter = new adapter();
        $query = "UPDATE `vendor` SET `first_name`='$firstname',`last_name`='$lastname',`email`='$email',`gender`='$gender',`mobile`='$mobile',`status`='$status',`company`='$company',`updated_at`='$datetime'
        WHERE `vendor_id` = $link";
        $result = $adapter->updateFun($query);
        header('location:Vendor.php?page=grid');
    }

    //delete data
    public function deleteFun(){
        $link = $_GET['id'];
        $adapter = new adapter();
        $query = "DELETE FROM `vendor` WHERE `vendor_id` = $link";
        $result = $adapter->deleteFun($query);

        header('location:Vendor.php?page=grid');    
    }
}
?>