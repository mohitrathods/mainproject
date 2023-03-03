<!-- all functions here : fetchall, fetchrow num, insert delete, update etc-->

<?php
class adapter {

    // CONNECTION
    public $config = [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'databasename' => 'project',
    ];

    public $connect = null;
    public function connection() {
        if ($this->connect != null) {

            return $this->connect;
        }
        $connect = mysqli_connect($this->config['host'],$this->config['username'],$this->config['password'],$this->config['databasename']);
        return $connect;
    }


    // FETCHALL FUNCTION
    public function fetchAll($query){
        $connect = $this->connection();
        $result = mysqli_query($connect,$query);

        //this query parameter is passed which will perform query on db through mysqli_query
        /*
                Object oriented style:
                $mysqli -> query(query, resultmode)
                Procedural style:
                mysqli_query(connection, query, resultmode) resultmode is optional
        */

        if($result->num_rows > 0 ){
                return $result->fetch_all(MYSQLI_ASSOC); 
                //returns all data from here defined once here can be used anywhere like in product, category anywhere
                //to access the data
            }
                return $result;
    }

    // INSERT FUNCTION
    public function insertData($query) {
        $connect = $this->connection();
        $result = mysqli_query($connect,$query);

        if ($result) {
            return $connect->insert_id;
        }
        else {
            return false;
        }
    }

    //FETCH ROW FUNCTION
    public function fetchRow($query){
        $connect = $this->connection();
        $result = mysqli_query($connect,$query);

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return false;
    }

    //fetch number
    public function fetchNumber($query){
        $connect = $this->connection();//call the connect fun store in connect variable
        $result = mysqli_query($connect,$query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
            }
            return false;
    }

    
    // EDIT / UPDATE FUNCTION
    public function updateFun($query){
        $connect = $this->connection();
        $result =  mysqli_query($connect,$query);

        if($result){
            return true;
        }
        else {
            return false;
        }
    }

    //DELET FUNCTION
    public function deleteFun($query){
        $connect = $this->connection();
        $result = mysqli_query($connect, $query);

        if($result){
            return true;
        }
        else {
            return false;
        }
    }
}

?>
