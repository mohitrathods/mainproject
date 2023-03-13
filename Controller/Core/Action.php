<?php
require_once 'model/core/adapter.php';
require_once 'model/core/Request.php';  
class Controller_Core_Action{

    public function redirect($url) {

        header("location:{$url}");
        exit();
        
    }
    //$this->redirect()

    public function getTemplate($templatePath){
        require_once 'View'.DS.$templatePath;
    }

    public $request = null;
    public $adapter = null;

    // public function setAdapter($query){
    //     $adapter = new adapter();
    //     $products = $adapter->fetchAll($query);
    //     return $this->adapter;
    // }
    //this->setAdapter();

    // public function setRequest($request){       
    //     //current request is null 
    //     $this->setRequest = $request;
    //     return $this;

    // }
    // public function getRequest(Model_Core_Request $request){
    //     if($this->request != null){
    //         return $this->setRequest();
    //     } //PERFORM LIKE GET REDIRECT
    //         $request = new Model_Core_Request();
    //         $this->$request = $request;
    //         return $this->request;
    // }
    
}

?>