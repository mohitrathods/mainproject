<?php
require_once 'Controller/Core/Action.php';
class Controller_Category extends Controller_Core_Action{
    public function gridAction(){
        $adapter = new adapter();
        $query = "SELECT * FROM `category` WHERE 1";
        $categories = $adapter->fetchAll($query);

        require_once 'view/category/grid.phtml';
    }

    //add function and insert function
    public function addAction(){
        require_once 'view/category/add.phtml';
    }

    public function insertAction(){

        $request =  new Model_Core_Request();
        $categories =  $request->getPost('category');

        $name = $categories['name'];
        $status = $categories['status'];
        $description = $categories['description'];
        
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");
        // echo $datetime;

        $query = "INSERT INTO `category`(`name`,`status`,`description`,`created_at`)
        VALUES ('$name','$status','$description','$datetime')";

        $adapter = new adapter();
        $categories = $adapter->insertData($query);

        $this->redirect("index.php?c=category&a=grid");
    }

    //edit and update function
    public function editAction(){
        $adapter = new adapter();
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');
        // print_r($link);
        
        $query = "SELECT * FROM `category` WHERE `category_id` = $link";
        $categories = $adapter->fetchRow($query);

        require_once 'view/category/edit.phtml';
    }

    public function updateAction(){
        $adapter = new adapter();

        // $link = $_GET['id'];
        $request = new Model_Core_Request();
        $link = $request->getParam('id');
        print_r($link);

        $categories = $request->getPost('category');

        $name = $categories['name'];
        $status = $categories['status'];
        $description = $categories['description'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");
        // echo $datetime;

        $query = "UPDATE `category` SET `name`='$name',`status`='$status',`description`='$description',`updated_at`='$datetime' WHERE `category_id` = $link";
        $categories = $adapter->updateFun($query);
        // print_r($categories);
        $this->redirect("index.php?c=category&a=grid");
    }
    

    //delete category
    public function deleteAction(){
        $adapter = new adapter();
        // $link = $_GET['id'];
        $request = new Model_Core_Request();
        $link = $request->getParam('id');
        print_r($link);


        $query = "DELETE FROM `category` WHERE `category_id`=$link";
        $categories = $adapter->deleteFun($query);

        $this->redirect("index.php?c=category&a=grid");
    }
}

?>