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


	$query = "select od.quant, od.id, it.name, it.price, it.price*od.quant as total from order_details od join items it on od.item_id=it.id where quant>0 
		and order_id=".$_REQUEST['id'];
		
		$result = mysql_query($query,$con); 
		if(mysql_num_rows($result)){
			while ($row = mysql_fetch_array($result)) {
				$row_array['id'] = $row['id'];
				$row_array['name'] = $row['name'];
				$row_array['quant'] = $row['quant'];
				$row_array['total'] = $row['total'];
				array_push($json_array,$row_array);
			}
				echo json_encode($json_array);
				//echo "hello";
		}


mysql_close($con);
?>