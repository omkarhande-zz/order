<?php
    $con = mysql_connect('localhost','root','');
    if (!$con)
    {
        die('-1'. mysql_error());
    }
    mysql_select_db('order_now', $con);

    $select_list = $_REQUEST['sel'];
    $query = "update items set is_spec = 0";
    $result = mysql_query($query,$con);     

    $query = "update items set is_spec = 1 where id in (".$select_list.")";
    echo $query;
    $result = mysql_query($query,$con); 

?>