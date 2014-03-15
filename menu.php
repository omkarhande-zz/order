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



	$query = "select * from items order by group_id";
	$result = mysql_query($query,$con); 
	
	

	if($result!=FALSE){
	while ($row = mysql_fetch_array($result)) {
		$row_array['name'] = $row['name'];
		$row_array['id'] = $row['id'];
		$row_array['des'] = $row['des'];
		$row_array['group_id'] = $row['group_id'];
		array_push($json_array,$row_array);
	}
		echo json_encode($json_array);
		//echo "hello";
	}
	else{
	$row_array['name'] = "Sample Item Name";
		$row_array['id'] = "-100";
		$row_array['des'] = "Sample items very very long desc";
		array_push($json_array,$row_array);
		echo json_encode($json_array);
	//	echo "Whazza";
	}

mysql_close($con);
?>