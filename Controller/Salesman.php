<?php 
require_once 'Controller/Core/Action.php';
class Controller_Salesman extends Controller_Core_Action{

    // fetch and show the data
    public function gridAction(){

        $adapter = new adapter();
        $query = "SELECT * FROM `salesman` WHERE 1";
        $salesmans =  $adapter->fetchAll($query);

        require_once 'view/salesman/grid.phtml';
    }

    //insert data and show file add
    public function addAction(){
        require_once 'view/salesman/add.phtml';
    }

    public function insertAction(){

        $request = new Model_Core_Request();
        $salesmans = $request->getPost('salesman');

        $firstname = $salesmans['firstname'];
        $lastname = $salesmans['lastname'];
        $email = $salesmans['email'];
        $gender = $salesmans['gender'];
        $mobile = $salesmans['firstname'];
        $status = $salesmans['status'];
        $company = $salesmans['company'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        $adapter = new adapter();
        $query = "INSERT INTO `salesman`(`first_name`,`last_name`,`email`,`gender`,`mobile`,`status`,`company`,`created_at`)
        VALUES('$firstname','$lastname','$email','$gender','$mobile','$status','$company','$datetime')";
        $salesmans = $adapter->insertData($query);

        $this->redirect("index.php?c=salesman&a=grid");
    }

    public function editAction(){
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        $adapter = new adapter();
        $query = "SELECT * FROM `salesman` WHERE `salesman_id` = $link";
        $salesmans = $adapter->fetchRow($query);

        require_once 'view/salesman/edit.phtml';
    }

    public function updateAction(){

        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        $salesmans = $request->getPost('salesman');

        $firstname = $salesmans['firstname'];
        $lastname = $salesmans['lastname'];
        $email = $salesmans['email'];
        $gender = $salesmans['gender'];
        $mobile = $salesmans['mobile'];
        $status = $salesmans['status'];
        $company = $salesmans['company'];

        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $datetime = date("y-m-d h:i:sA");

        // $link =  $_GET['id'];

        $adapter = new adapter();
        $query = "UPDATE `salesman` SET `first_name`='$firstname',`last_name`='$lastname',`email`='$email',`gender`='$gender',`mobile`='$mobile',`status`='$status',`company`='$company',`updated_at`='$datetime'
        WHERE `salesman_id` = $link";
        $salesmans = $adapter->updateFun($query);
        $this->redirect("index.php?c=salesman&a=grid");
    }

    //delete the data of salesman
    public function deleteAction(){
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        $adapter = new adapter();
        $query = "DELETE FROM `salesman` WHERE `salesman_id` = $link";
        $salesmans = $adapter->deleteFun($query);

        $this->redirect("index.php?c=salesman&a=grid");    
    }
}
?>