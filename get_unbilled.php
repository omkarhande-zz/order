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



	$query = "select o.*, p.id as pair_id from orders o join pairs p on p.cust_id=o.cust_id where o.stat = 4 and p.waiter_id=".$_REQUEST['waiter_id'] ;
	$result = mysql_query($query,$con); 
	
	

	if($result!=FALSE){
		while ($row = mysql_fetch_array($result)) {
			$row_array['id'] = $row['id'];
			$row_array['cust_id'] = $row['cust_id'];
			$row_array['date_added'] = $row['date_added'];
			$row_array['stat'] = $row['stat'];
			$row_array['name'] = $row['name'];
			$row_array['pair_id'] = $row['pair_id'];
			array_push($json_array,$row_array);
		}
		echo json_encode($json_array);
	}

mysql_close($con);
?>