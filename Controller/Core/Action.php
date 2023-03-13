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

    
}

?>