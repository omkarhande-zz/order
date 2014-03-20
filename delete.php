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
	
	$query = "select o.stat,i.name, od.quant,od.order_id,od.item_id,od.quant from orders o JOIN order_details od JOIN items i ON od.order_id = o.id AND od.item_id=i.id where od.id = ".$_REQUEST['id'];
	$result = mysql_query($query,$con); 
	// die($query);
	if($result != FALSE){
		$row = mysql_fetch_array($result);
		$order_id = $row['order_id'];
		$item_id = $row['item_id'];
		$name = $row['name'];
		$quant = $row['quant'];
		if($row['stat'] == "1" OR $row['stat'] == "2"){
				
			$query = "delete from order_details where id=".$_REQUEST['id'];
			$rsp['response'] = "Item deleted";
		}else{
			$query = "insert into requests(order_id, item_id, quant,order_details_id,type,approved) values($order_id, $item_id,$quant, ".$_REQUEST['id'].",2,0)";
			$rsp['response'] = "Request sent for approval";
		}
		$result = mysql_query($query,$con); 
		array_push($json_array,$rsp);
		echo json_encode($json_array);

	}
mysql_close($con);
?>