<?php 
require_once 'model/core/adapter.php';

//link setup
$link = $_GET['a'].'Action';
$Salesman = new Salesman();
$Salesman->$link();

class Salesman{

    // fetch and show the data
    public function gridAction(){

        $adapter = new adapter();
        $query = "SELECT * FROM `salesman` WHERE 1";
        $result =  $adapter->fetchAll($query);

        require_once 'view/salesman/grid.phtml';
    }

    //insert data and show file add
    public function addAction(){
        require_once 'view/salesman/add.phtml';
    }

    public function insertAction(){
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
        $query = "INSERT INTO `salesman`(`first_name`,`last_name`,`email`,`gender`,`mobile`,`status`,`company`,`created_at`)
        VALUES('$firstname','$lastname','$email','$gender','$mobile','$status','$company','$datetime')";
        $result = $adapter->insertData($query);

        header('location:Salesman.php?a=grid');
    }

    public function editAction(){
        $link = $_GET['id'];
        $adapter = new adapter();
        $query = "SELECT * FROM `salesman` WHERE `salesman_id` = $link";
        $result = $adapter->fetchRow($query);

        require_once 'view/salesman/edit.phtml';
    }

    public function updateAction(){
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
        $query = "UPDATE `salesman` SET `first_name`='$firstname',`last_name`='$lastname',`email`='$email',`gender`='$gender',`mobile`='$mobile',`status`='$status',`company`='$company',`updated_at`='$datetime'
        WHERE `salesman_id` = $link";
        $result = $adapter->updateFun($query);
        header('location:Salesman.php?a=grid');
    }

    //delete the data of salesman
    public function deleteAction(){
        $link = $_GET['id'];
        $adapter = new adapter();
        $query = "DELETE FROM `salesman` WHERE `salesman_id` = $link";
        $result = $adapter->deleteFun($query);

        header('location:Salesman.php?a=grid');    
    }
}
?>