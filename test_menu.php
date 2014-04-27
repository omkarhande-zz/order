<?php

	$con = mysql_connect('sql3.freemysqlhosting.net','sql336816','qM3*vM3%');
	if (!$con)
	  {
	  die('-1'. mysql_error());
	  }
	mysql_select_db('sql336816', $con);
$json_array = array();



	$query = "select * from items order by group_id";
	$result = mysql_query($query,$con); 
	
	

	if($result!=FALSE){
	while ($row = mysql_fetch_array($result)) {
		$row_array['name'] = $row['name'];
		$row_array['id'] = $row['id'];
		$row_array['des'] = $row['des'];
		$row_array['group_id'] = $row['group_id'];
		$row_array['rate'] = $row['price'];
		$row_array['image_name'] = $row['image_name'];
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