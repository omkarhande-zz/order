<?php

$configs = include('config.php');
	// print_r($configs);
	$con = mysql_connect($configs['host'],$configs['username'],$configs['password']);
	if (!$con)
	  {
	  die('-1'. mysql_error());
	  }
	mysql_select_db($configs['db'], $con);
$apiKey = "AIzaSyCUXxiGzjyfWcpncCZ20ppEAGNsI_b2Nf0";
$type = $_REQUEST['type'];
$registrationIDs = array();

if($type==1){
	$cust_id = $_REQUEST['user_id'];
	$query = "select gcm_id from users where user_type = 1";
}else{
	$waiter_id = $_REQUEST['user_id'];
	$query = "select gcm_id from users where user_type = 2";
}
	$result = mysql_query($query,$con); 

	if($result!=FALSE){
		while ($row = mysql_fetch_array($result)) {
			// $row_array['gcm_id'] = $row['gcm_id'];
			array_push($registrationIDs,$row['gcm_id']);
		}
	}

	print_r($registrationIDs);


// $registrationIDs = array("APA91bH_YroqLMsfQXJbyOyX7QueJM4OampiZWhrS3tEhvFmDMvH8eZ87_1R0YTsV8ByERsCP3LHKGOSvFw25h6l6uMdbmwGPTn-MWZ0iIy3E_GdSVB7ZQwmHZKHrcGJfpdtnh2NHGPBfb6bMXKCQEHmnTYYG833pBn69h6d0yHwIKd0S58yD6Q",
// 	"APA91bE4uQoGismgRcbbwT69-4vpgyT1BuXPAxZNnRwdTJZGt_XJ34-V2DTsL591IKKSDLabMb-FH_ABfDA83A19qG9rYmJvWHPjkQ6CBUJGOQG4fy8cGDGFDUPzi_60jMXiuuwDLLHqZgPJyHtibrBSHF0XVZQn2v95DT7s7ldces0jO0umrpY");
// $message = "testing Process";
$message = $_REQUEST['msg'];
$title = $_REQUEST['title'];
//                 array('message' => $message, 'tickerText' => $tickerText, 'contentTitle' => $contentTitle, "contentText" => $contentText) );
$url = 'https://android.googleapis.com/gcm/send';
$fields = array(
        'registration_ids'  => $registrationIDs,
        'data'              => array("contentTitle"=>$title, "contentText"=>$message),
        );
$headers = array( 
        'Authorization: key=' . $apiKey,
        'Content-Type: application/json'
        );
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $url );
curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($fields) );

$result = curl_exec($ch);
if(curl_errno($ch)){ echo 'Curl error: ' . curl_error($ch); }
curl_close($ch);
echo $result;
?>