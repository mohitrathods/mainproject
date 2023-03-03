<?php
// echo "<pre>";

require_once 'model/core/adapter.php';

$link = $_GET['page'].'Fetch'; //page.Fetch > gridFetch
$mediaclass = new ProductMedia();
$mediaclass->$link();

class ProductMedia {
    
    //insert------------
    public function gridFetch(){

        $adaptervar = new adapter();
        //fetch data
        $link = $_GET['id'];
        //query
        $query = "SELECT * FROM `product_media` WHERE `product_id` = $link"; //where product id = 1 and in that there are 4 media
        $result = $adaptervar->fetchAll($query);

        // print_r($result);
        //render grid file
        require_once 'view/product_media/grid.phtml';
    }


    //ADD---------------
    public function addFetch(){
        $link = $_GET['id'];
        //render add.phtml
        require_once 'view/product_media/add.phtml';
    }

    public function insertFetch(){
        $adaptervar = new adapter();

        $link = $_GET['id'];

        //get values of input
        $name = $_POST['name'];
        $status = $_POST['status'];
        $image = $_FILES['image'];
        
        $query = "INSERT INTO `product_media`(`product_id`,`name`,`status`,`image`) VALUES ('$link','$name','$status','$image')";
        $result = $adaptervar->insertData($query);
        // print_r($result);
        // print_r($image['name']);
        // print_r($image);
        
        $file = explode('.',$image['name']);
        // print_r($file);

        $filename = $result.'.'.$file[1];
        // print_r($filename);
        // die();

        //image destination
        $destination = 'images/'.$filename;

        //move file in images folder 
        $move = move_uploaded_file($image['tmp_name'], $destination);

        $update = "UPDATE `product_media` SET `image` = '$filename' WHERE `media_id` = $result";
        $adaptervar = $adaptervar->updateFun($update);
        header("location:ProductMedia.php?page=grid&id={$link}");

    }

    public function updateFetch() {
        $link = $_GET['id'];
        print_r($link);

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
        $result = $adapter->updateFun($update);

        //
        $update = "UPDATE `product_media` SET `base` = 1 WHERE `media_id` = $base";
        $result = $adapter->updateFun($update);

        $update = "UPDATE `product_media` SET `thumbnail` = 1 WHERE `media_id` = $thumbnail";
        $result = $adapter->updateFun($update);

        $update = "UPDATE `product_media` SET `small` = 1 WHERE `media_id` = $small";
        $result = $adapter->updateFun($update);

        $id = join(',',$gallery);
        $update = "UPDATE `product_media` SET `gallery` = 1 WHERE `media_id` IN ($id)";
        $result = $adapter->updateFun($update);
        header("location:ProductMedia.php?page=grid&id={$link}");
        
    }

    //DELETE
    public function deleteFetch(){
        $link = $_GET['id'];

        //
        $delete = $_POST['delete'];
        print_r($_POST);
    }
}

?>