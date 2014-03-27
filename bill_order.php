<?php

	$configs = include('config.php');
	// print_r($configs);
	$con = mysql_connect($configs['host'],$configs['username'],$configs['password']);
	if (!$con)
	  {
	  die('-1'. mysql_error());
	  }
	mysql_select_db($configs['db'], $con);

	$json_array = array();

	$query = "update orders set stat=5 where id = ".$_REQUEST['order_id'];
	$result = mysql_query($query,$con); 

mysql_close($con);
?>