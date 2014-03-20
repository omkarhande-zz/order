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



	$query = "select r.id, i.name,r.quant,r.order_id, r.item_id, r.order_details_id,r.type from requests r left join 
	items i on r.item_id = i.id where r.approved=0";
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
			array_push($json_array,$row_array);
		}
		echo json_encode($json_array);
	}

mysql_close($con);
?>