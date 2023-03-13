<?php
class Model_Core_Request {
    
    public function getPost($key = null, $value = null){
        if($key == null){
            return $_POST;
        }
        if(array_key_exists($key,$_POST)){
            return $_POST[$key]; // key='product'
        }
    return $value;
    }

    public function getParam($key = null, $value = null){
        if($key == null){
            return $_GET;
        }
        if(array_key_exists($key,$_GET)){
            return $_GET[$key];
        }
    return $value;
    }

    public function getActionName(){
        return $this->getParam('a', 'index');
    }

    public function getControllerName(){
        return $this->getParam('c', 'index');
    }

    public function getRequest($key = null, $value = null){
        if($key == null){
            return $_POST;
        }
        if(array_key_exists($key, $_POST)){
            return $_POST[$key];
        }
    }
}

?>