<?php
if (isset($_GET["regId"]) && isset($_GET["message"])) {
    $regId = $_GET["regId"];
    $message = $_GET["message"];
    $type = $_GET['type'];
    $title = $_GET['title'];
     
    include_once './GCM.php';
     
    $gcm = new GCM();
 
    $registatoin_ids = array($regId);
    $message = array("message"=>$message,"ticketText"=>"New Notificatin", "contentTitle"=>$title, "contentText"=>$message." - Sent via web","type"=>$type);
    $result = $gcm->send_notification($registatoin_ids, $message);
 
    echo $result;
}
?>