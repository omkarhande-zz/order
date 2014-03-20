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



	$query = "select * from requests where id=".$_REQUEST['id'];
	$result = mysql_query($query,$con); 
	
	

	if($result!=FALSE){
		while ($row = mysql_fetch_array($result)) {
			$row_array['id'] = $row['id'];
			$row_array['name'] = $row['name'];
			$row_array['order_id'] = $row['order_id'];
			$row_array['item_id'] = $row['item_id'];
			$row_array['quant'] = $row['quant'];
			$row_array['order_details_id'] = $row['order_details_id'];
			$row_array['type'] = $row['type'];
			//array_push($json_array,$row_array);
		}
		//echo json_encode($json_array);
		if($row_array['type'] == "2"){
			$query = "delete from order_details where id = ".$row_array['order_details_id'];
		}else{
			$query = "insert into order_details(order_id, item_id, quant) values($row_array[order_id],$row_array[item_id],$row_array[quant])";
		}
		mysql_query($query,$con);
		$query = "update requests set approved=1 where id = ".$_REQUEST['id'];
		// die($query);
		mysql_query($query,$con);
	}

mysql_close($con);
?>