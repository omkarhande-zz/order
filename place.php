<?php
	/**
		Connection configuration
		
    */
	$configs = include('config.php');
	// print_r($configs);
	$con = mysql_connect($configs['host'],$configs['username'],$configs['password']);
	if (!$con)
	  {
	  die('-1'. mysql_error());
	  }
	mysql_select_db($configs['db'], $con);

	$json_array = array();
	
	$query = "select id,stat from orders where stat in (1,2,3) and cust_id=".$_REQUEST['cust_id'];
	$result = mysql_query($query,$con); 
	if(mysql_num_rows($result)){

		$row = mysql_fetch_array($result);
		$order_id = $row['id'];
		$stat = $row['stat'];
		if($stat == 1){
			$query = "update orders set stat = 2 where id =".$order_id;
			$result = mysql_query($query,$con); 
			$row['rsp'] = "Order Placed";
		}else if ($stat == 2){
			$row['rsp'] = "Order is up for approval";
		}else{
			$row['rsp'] = "Order was already placed";
		}
		array_push($json_array,$row);
		echo json_encode($json_array);
	}else{
		$row['rsp'] = "No active orders";
		array_push($json_array,$row);
		echo json_encode($json_array);
	}

	

	mysql_query($query, $con);
mysql_close($con);
?>