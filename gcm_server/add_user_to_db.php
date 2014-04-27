<?php
    $con = mysql_connect('localhost','root','');
    if (!$con)
    {
        die('-1'. mysql_error());
    }
    mysql_select_db('order_now', $con);

    if (isset($_GET["name"]) && isset($_GET["email"]) && isset($_GET["pass"]) && isset($_GET["type"])) {

        $name = $_GET["name"];
        $email = $_GET["email"];
        $pass = $_GET['pass'];
        $type = $_GET['type'];
        if ($type == "user"){
            $type = 2;
        }else if ($type == "waiter"){
            $type = 1;
        }else if ($type == "admin"){
            $type = 3;
        }
         
    $query = "insert into users(name, email, pass, user_type, active) values('$name', '$email', '$pass', $type, 1)";
    $result = mysql_query($query,$con); 
    $last_inserted = mysql_insert_id();

    if($type == 2){
        $query = "insert into pairs(cust_id, waiter_id) values ($last_inserted, (select t.waiter_id from (select count(1) as count,waiter_id from pairs group by waiter_id) as t order by t.count asc limit 1))";
        mysql_query($query,$con);
    }

    }
?>