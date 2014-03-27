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



	$query = "	select 
					req.*, 
					i.name
				from 
					(	select 
							r.*, p.id as pair_id
						from 
							requests r 
							join orders o 
							join pairs p 
						on r.order_id = o.id and o.cust_id = p.cust_id 
						where p.waiter_id=".$_REQUEST['waiter_id']."
					) as req 
				left join items i on req.item_id = i.id 
				where req.approved=0";

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
			$row_array['pair_id'] = $row['pair_id'];
			array_push($json_array,$row_array);
		}
		echo json_encode($json_array);
	}

mysql_close($con);
?>