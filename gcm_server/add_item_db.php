<?php
    $con = mysql_connect('localhost','root','');
    if (!$con)
    {
        die('-1'. mysql_error());
    }
    mysql_select_db('order_now', $con);

    if (isset($_GET["name"]) && isset($_GET["desc"]) && isset($_GET["price"]) && isset($_GET["type"])) {

        $name = $_GET["name"];
        $desc = $_GET["desc"];
        $price = $_GET['price'];
        $type = $_GET['type'];
         
    $query = "insert into items(name, des, price, group_id, is_spec) values('$name', '$desc', '$price', $type, 0)";
    echo $query;
    $result = mysql_query($query,$con); 

    }
?>