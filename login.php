<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('-1'. mysql_error());
  }
mysql_select_db("order_now", $con);
$json_array = array();


if($_REQUEST['type'] == 'user')
{
	$query = "select * from users where email = '".$_REQUEST['email']."' and pass = '".$_REQUEST['pass']."'";
	$result = mysql_query($query,$con); 
	
	

	if($result!=FALSE){
	while ($row = mysql_fetch_array($result)) {
		$row_array['name'] = $row['name'];
		$row_array['id'] = $row['id'];
		$row_array['active'] = $row['active'];
		// $row_array['contact'] = $row['contact'];
		
		// $row_array['status']=$row['status'];
		//echo $row['name'];
		array_push($json_array,$row_array);
	}

		echo json_encode($json_array);
		//echo "hello";
	}
	else{
		$row_array['active']=0;
		array_push($json_array,$row_array);
		echo json_encode($json_array);
	//	echo "Whazza";
	}
}

mysql_close($con);
?>