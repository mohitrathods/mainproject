<?php 
require_once 'Controller/Core/Action.php';
class Controller_Customer extends Controller_Core_Action {
    
    //get data from db and show page
    public function gridAction(){
        $adapter = new adapter();
        $query =  "SELECT * FROM `customer` WHERE 1";
        $customers = $adapter->fetchAll($query);

        require_once 'view/customer/grid.phtml';
    }

    //add data and show page
    public function addAction(){
        require_once 'view/customer/add.phtml';
    }

    public function insertAction(){

        $request = new Model_Core_Request();
        $customers = $request->getPost('customer');

        $firstname = $customers['first_name'];
        $lastname = $customers['last_name'];
        $email = $customers['email'];
        $gender = $customers['gender'];
        $mobile = $customers['mobile'];
        $status = $customers['status'];
        
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $adapter = new adapter();
        $query = "INSERT INTO `customer`(`first_name`,`last_name`,`email`,`gender`,`mobile`,`status`,`created_at`)
        VALUES ('$firstname','$lastname','$email','$gender','$mobile','$status','$datetime')";
        $customers = $adapter->insertData($query);
        print_r($customers);
        $this->redirect("index.php?c=customer&a=grid");
    }

    //edit and update
    public function editAction(){

        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');
        print_r($link);

        $adapter = new adapter();
        $query = "SELECT * FROM `customer` WHERE `customer_id` = $link";
        $customers = $adapter->fetchRow($query);

        require_once 'view/customer/edit.phtml';
    }

    public function updateAction(){

        $request = new Model_Core_Request();
        $link = $request->getParam('id');
        print_r($link);

        $customers = $request->getPost('customer');

        $firstname = $customers['firstname'];
        $lastname = $customers['lastname'];
        $email = $customers['email'];
        $gender = $customers['gender'];
        $mobile = $customers['mobile'];
        $status = $customers['status'];
        
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        // $link = $_GET['id'];

        $query = "UPDATE `customer` SET `first_name`='$firstname',`last_name`='$lastname',`email`='$email',`gender`='$gender',`mobile`='$mobile',`status`='$status',`updated_at`='$datetime'
        WHERE `customer_id` = $link";

        $adapter = new adapter();
        $customers = $adapter->updateFun($query);

        $this->redirect("index.php?c=customer&a=grid");
    }

    public function deleteAction(){
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');
        print_r($link);

        $adapter = new adapter();

        $query = "DELETE FROM `customer` WHERE `customer_id` = $link";
        $adapter->deleteFun($query);

        $this->redirect("index.php?c=customer&a=grid");

    }
}
?>