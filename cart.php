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
	
	$query = "select id from orders where stat in (1,2,3,4,5) and cust_id=".$_REQUEST['cust_id'];
	// die($query);
	$result = mysql_query($query,$con); 
	if($result!=FALSE){
	if(mysql_num_rows($result)){

		$row = mysql_fetch_array($result);
		$order_id = $row['id'];

		$query = "select od.quant, od.id, it.name, it.price, it.price*od.quant as total from order_details od join items it on od.item_id=it.id where quant>0 
		and order_id=".$order_id;
		
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

	}else{
				$row_array['id'] = "10001";
				$row_array['name'] = "Cart is empty";
				$row_array['quant'] = "0";
				$row_array['total'] = "0";
				array_push($json_array,$row_array);
				echo json_encode($json_array);
		}
}

	

	mysql_query($query, $con);
mysql_close($con);
?>