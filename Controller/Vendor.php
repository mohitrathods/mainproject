<?php 
require_once 'Controller/Core/Action.php';
class Controller_Vendor extends Controller_Core_Action{

    // fetch and show the data
    public function gridAction(){

        $adapter = new adapter();
        $query = "SELECT * FROM `vendor` WHERE 1";
        $vendors =  $adapter->fetchAll($query);

        require_once 'view/vendor/grid.phtml';
    }

    //insert data
    public function addAction(){
        require_once 'view/vendor/add.phtml';
    }

    public function insertAction(){

        $request = new Model_Core_Request();
        $vendors = $request->getPost('vendor');

        $firstname = $vendors['firstname'];
        $lastname = $vendors['lastname'];
        $email = $vendors['email'];
        $gender = $vendors['gender'];
        $mobile = $vendors['firstname'];
        $status = $vendors['status'];
        $company = $vendors['company'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $adapter = new adapter();
        $query = "INSERT INTO `vendor`(`first_name`,`last_name`,`email`,`gender`,`mobile`,`status`,`company`,`created_at`)
        VALUES('$firstname','$lastname','$email','$gender','$mobile','$status','$company','$datetime')";
        $vendors = $adapter->insertData($query);

        $this->redirect("index.php?c=vendor&a=grid");
    }

    //FETCH THE ROW AND EDIT THE DATA
    public function editAction(){
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        $adapter = new adapter;
        $query = "SELECT * FROM `vendor` WHERE `vendor_id` = $link";
        $vendors = $adapter->fetchRow($query);

        require_once 'view/vendor/edit.phtml';
    }

    public function updateAction(){

        $request = new Model_Core_Request();
        $vendors = $request->getPost('vendor');

        $firstname = $vendors['firstname'];
        $lastname = $vendors['lastname'];
        $email = $vendors['email'];
        $gender = $vendors['gender'];
        $mobile = $vendors['mobile'];
        $status = $vendors['status'];
        $company = $vendors['company'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $link =  $_GET['id'];

        $adapter = new adapter();
        $query = "UPDATE `vendor` SET `first_name`='$firstname',`last_name`='$lastname',`email`='$email',`gender`='$gender',`mobile`='$mobile',`status`='$status',`company`='$company',`updated_at`='$datetime'
        WHERE `vendor_id` = $link";
        $vendors = $adapter->updateFun($query);
        $this->redirect("index.php?c=vendor&a=grid");
    }

    //delete data
    public function deleteAction(){
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        $adapter = new adapter();
        $query = "DELETE FROM `vendor` WHERE `vendor_id` = $link";
        $vendors = $adapter->deleteFun($query);

        $this->redirect("index.php?c=vendor&a=grid");    
    }
}
?>