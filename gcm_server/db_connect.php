<?php
  
class DB_Connect {
  
    // constructor
    function __construct() {
  
    }
  
    // destructor
    function __destruct() {
        // $this->close();
    }
  
    // Connecting to database
    public function connect() {
        require_once 'config.php';
        // connecting to mysql
        $con = mysql_connect("localhost", "root", "");
        // selecting database
        mysql_select_db("order_now");
  
        // return database handler
        return $con;
    }
  
    // Closing database connection
    public function close() {
        mysql_close();
    }
  
} 
?>