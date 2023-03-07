<?php
require_once 'Controller/Core/Front.php';

class practice {
    public static function func(){
        // echo "static";
        //self::func();//class ni andar access krva mate
        //sada class mate $this

        $front = new Controller_Core_Front();
        $front->callController();
    }
}

practice::func(); //how to access static
//sada class mate object banavi ne call

//have 2 parameters pass thase a ma grid pass c ma product pass 
//have  category evu url ma pass ny thay khali c pass thase
//product.php, customer.php e badhay controller chhe
//practice is index.php only index file will be called
?>