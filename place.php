<?php
	$con = mysql_connect("localhost","root","");
	if (!$con)
	  {
	  die('-1'. mysql_error());
	  }
	mysql_select_db("order_now", $con);

	$json_array = array();
	
	$query = "select id,stat from orders where cust_id=".$_REQUEST['cust_id'];
	// die($query);
	$result = mysql_query($query,$con); 
	if($result!=FALSE){
	if(mysql_num_rows($result)){

		$row = mysql_fetch_array($result);
		$order_id = $row['id'];
		$stat = $row['stat'];
		if($stat == 1){
			$query = "update orders set stat = 2 where id =".$order_id;
			$result = mysql_query($query,$con); 
			$row['rsp'] = "Order Placed";
		}else{
			$row['rsp'] = "Order was already placed";
		}
		array_push($json_array,$row);
		echo json_encode($json_array);
	}
}

	

	mysql_query($query, $con);
mysql_close($con);
?>