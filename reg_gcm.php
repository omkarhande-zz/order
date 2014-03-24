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
	
	$query = "insert into gcm_users (gcm_regid, name, email) values('".$_REQUEST['reg_id']."','omkar', 'omkarsayajihande@gmail.com')";
	// die($query);
	$result = mysql_query($query,$con); 
mysql_close($con);
?>