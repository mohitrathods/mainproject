<?php 

require_once 'Model/Core/Request.php';

class Controller_Core_Front {
    
    public function init(){

        $request = new Model_Core_Request();
        $controllerName = $request->getControllerName();

        $controllerClassName = 'Controller_'.ucwords($controllerName,'_');

        $controllerPathName = 'Controller/'.ucfirst($controllerName).'.php';
        require_once $controllerPathName;
        
        //make object to fire action > gridAction etc
        $resultClassName = new $controllerClassName();

        $actionPath = $request->getActionName().'Action';

        $resultClassName->$actionPath();

        // print_r($controllerName);
        // echo "<br>";
        // print_r($controllerClassName);
        // echo "<br>";
        // print_r($controllerPathName);
        // echo "<br>";
        // print_r($resultClassName);
        // echo "<br>";
        // print_r($actionPath);
        // echo "<br>";
        // print_r($resultClassName->$actionPath);
        

    }
}
?>

<!-- 
> all things by $_GET method by accessing request class 
> get controller name > product 
> get controller class name and concate it 
- controller class name = Controller_Product
> get controller path name > Controller/Product > for each i made dynamic

> get access tocontroller by making object
- new $controllerClassName > Controller_Product
- FIRE THE FUNCTION > Controller_Product (
    gridAction{}
)

c=product -
access the Product controller
get action name and fire the action when c=product in url 

 -->