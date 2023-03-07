<?php
class Model_Core_Request {
    public function getPost($key = null, $value = null){
        if($key == null){
            // echo "null";
            return $_POST;
        }
        if(array_key_exists($key,$_POST)){
            // echo "data";
            return $_POST[$key];
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
}
// http://localhost/phpproject/index.php?c=product
// $access = new Model_Core_Request();
// $access->getPost();
//if error in url, show index if not show controller or action etc
?>