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

	$status = 0;

	$query = "select * from orders where stat in (1,2,3,4,5) and cust_id=".$_REQUEST['cust_id'];
	$result = mysql_query($query,$con); 

	if(mysql_num_rows($result)){
		$row = mysql_fetch_array($result);
		$status = $row['stat'];

		if($status == "1"){
			$row_array['msg']="You have not ordered anything yet";
			// array_push($json_array,$row_array);
			// echo json_encode($json_array);
		}else if($status == "2"){
			$row_array['msg']="Your order is yet to be approved";
			// array_push($json_array,$row_array);
		}else if($status == "3"){
			$query = "update orders set stat = 4 where cust_id =".$_REQUEST['cust_id'];
			$result = mysql_query($query,$con); 
			$row_array['msg']="Sending bill request";
		}else if($status == "4"){
			$row_array['msg']="Your bill request was already recieved";
		}else if($status == "5"){
			$row_array['msg']="Your bill is getting ready";
		}
		
	}else{
		$row_array['msg']="There are no active orders on your name";
	}
	array_push($json_array,$row_array);
	echo json_encode($json_array);
mysql_close($con);
?>