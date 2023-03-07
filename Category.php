<?php
//get  access to adapter class
require_once 'model/core/adapter.php';

//make link accessible
$link = $_GET['a'].'Action';
//pass the link in class below
$Category = new Category();
$Category->$link();

class Category{
    
    //show grid page and fetch data
    public function gridAction(){
        $adapter = new adapter();
        $query = "SELECT * FROM `category` WHERE 1";
        $result = $adapter->fetchAll($query);

        require_once 'view/category/grid.phtml';
    }

    //add function and insert function
    public function addAction(){
        require_once 'view/category/add.phtml';
    }

    public function insertAction(){
        $name = $_POST['name'];
        $status = $_POST['status'];
        $description = $_POST['description'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");
        // echo $datetime;

        $query = "INSERT INTO `category`(`name`,`status`,`description`,`created_at`)
        VALUES ('$name','$status','$description','$datetime')";

        $adapter = new adapter();
        $result = $adapter->insertData($query);

        header('location:Category.php?a=grid');
    }

    //edit and update function
    public function editAction(){
        $adapter = new adapter();
        //show input data of particular row
        $link = $_GET['id'];
        // print_r($link);
        $query = "SELECT * FROM `category` WHERE `category_id` = $link";
        $result = $adapter->fetchRow($query);

        require_once 'view/category/edit.phtml';
    }

    public function updateAction(){
        $adapter = new adapter();

        $link = $_GET['id'];

        $name = $_POST['name'];
        $status = $_POST['status'];
        $description = $_POST['description'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");
        // echo $datetime;

        $query = "UPDATE `category` SET `name`='$name',`status`='$status',`description`='$description',`updated_at`='$datetime' WHERE `category_id` = $link";
        $result = $adapter->updateFun($query);
        // print_r($result);
        header('location:Category.php?a=grid');
    }
    

    //delete category
    public function deleteAction(){
        $adapter = new adapter();
        $link = $_GET['id'];

        $query = "DELETE FROM `category` WHERE `category_id`=$link";
        $result = $adapter->deleteFun($query);

        header('location:Category.php?a=grid');
    }
}
?>