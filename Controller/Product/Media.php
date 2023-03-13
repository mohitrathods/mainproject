<?php


class Controller_Product_Media{

    //insert------------
    public function gridAction(){

        $adapter = new adapter();
        //fetch data
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');
        //print_r($link);

        //query
        $query = "SELECT * FROM `product_media` WHERE `product_id` = $link"; //where product id = 1 and in that there are 4 media
        $productmedia = $adapter->fetchAll($query);

        // print_r($productmedia);
        //render grid file
        require_once 'view/product_media/grid.phtml';
    }


    //ADD---------------
    public function addAction(){
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        //render add.phtml
        require_once 'view/product_media/add.phtml';
    }

    public function insertAction(){
        $adapter = new adapter();

        // $link = $_GET['id'];
        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        //get values of input
        $name = $_POST['name'];
        $status = $_POST['status'];
        $image = $_FILES['image'];
        
        $query = "INSERT INTO `product_media`(`product_id`,`name`,`status`,`image`) VALUES ('$link','$name','$status','$image')";
        $productmedia = $adapter->insertData($query);
        // print_r($productmedia);
        // print_r($image['name']);
        // print_r($image);
        
        $file = explode('.',$image['name']);
        // print_r($file);

        $filename = $productmedia.'.'.$file[1];
        // print_r($filename);
        // die();

        //image destination
        $destination = 'images/'.$filename;

        //move file in images folder 
        $move = move_uploaded_file($image['tmp_name'], $destination);

        $update = "UPDATE `product_media` SET `image` = '$filename' WHERE `media_id` = $productmedia";
        $adapter = $adapter->updateFun($update);
        header("location:index.php?c=productmedia&a=grid&id={$link}");

    }

    public function updateAction() {
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');
        // print_r($link);

        //get values from input
        $base = $_POST['base'];
        $thumbnail = $_POST['thumbnail'];
        $small = $_POST['small'];
        $gallery = $_POST['gallery'];

        print_r($_POST);
        // die();

        //update query
        $update = "UPDATE `product_media` SET `base` = 0, `thumbnail` = 0, `small`=0,`gallery`=0";
        $adapter = new adapter();
        $productmedia = $adapter->updateFun($update);

        //
        $update = "UPDATE `product_media` SET `base` = 1 WHERE `media_id` = $base";
        $productmedia = $adapter->updateFun($update);

        $update = "UPDATE `product_media` SET `thumbnail` = 1 WHERE `media_id` = $thumbnail";
        $productmedia = $adapter->updateFun($update);

        $update = "UPDATE `product_media` SET `small` = 1 WHERE `media_id` = $small";
        $productmedia = $adapter->updateFun($update);

        $id = join(',',$gallery);
        $update = "UPDATE `product_media` SET `gallery` = 1 WHERE `media_id` IN ($id)";
        $productmedia = $adapter->updateFun($update);
        header("location:index.php?c=productmedia&a=grid&id={$link}");
        
    }

    //DELETE
    public function deleteAction(){
        // $link = $_GET['id'];

        $request = new Model_Core_Request();
        $link = $request->getParam('id');

        //
        $delete = $_POST['delete'];
        print_r($_POST);
    }
}
?>