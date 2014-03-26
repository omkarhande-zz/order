<?php

	$configs = include('config.php');
	// print_r($configs);
	$con = mysql_connect($configs['host'],$configs['username'],$configs['password']);
	if (!$con)
	  {
	  die('-1'. mysql_error());
	  }
	mysql_select_db($configs['db'], $con);

	$query = "select id from orders where stat in (1,2,3) and cust_id = ".$_REQUEST['cust_id'];
	$result = mysql_query($query,$con); 
	if($result!=FALSE){
		while ($row = mysql_fetch_array($result)) {
			$order_id = $row['id'];
		}
	}

	$query = "insert into feedback(order_id, content) values (".$order_id.",'".$_REQUEST['content']."')";
	// die($query);
	$result = mysql_query($query,$con); 
	mysql_close($con);

?>