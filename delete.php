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
	
	$query = "select o.stat from orders o JOIN order_details od ON od.order_id = o.id where od.id = ".$_REQUEST['id'];
	$result = mysql_query($query,$con); 
	// die($query);
	if($result != FALSE){
		$row = mysql_fetch_array($result);
		if($row['stat'] == "1"){
				
			$query = "delete from order_details where id=".$_REQUEST['id'];
			$rsp['response'] = "Item deleted";
		}else{
			$query = "insert into requests(order_details_id) values(".$_REQUEST['id'].")";
			$rsp['response'] = "Request sent for approval";
		}
		// die($query);
		$result = mysql_query($query,$con); 
		array_push($json_array,$rsp);
		echo json_encode($json_array);

	}
mysql_close($con);
?>