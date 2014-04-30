<?php
    $con = mysql_connect('localhost','root','');
    if (!$con)
    {
        die('-1'. mysql_error());
    }
    mysql_select_db('order_now', $con);
    $query = "insert into feedback(order_id, content) values(1, 'testing')";
    // echo $query;
    if(!empty($_FILES["file"]["name"])){
         $result = mysql_query($query,$con); 
     }

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    // die($extension."hello");

    if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/x-png")
    || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 20000)
    && in_array($extension, $allowedExts)) {
      if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
      } else {
        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
        if (file_exists("images/" . $_FILES["file"]["name"])) {
          echo $_FILES["file"]["name"] . " already exists. ";
        } else {
          move_uploaded_file($_FILES["file"]["tmp_name"],
          "upload/" . $_FILES["file"]["name"]);
          echo "Stored in: " . "images/" . $_FILES["file"]["name"];
        }
      }
    } else {
      echo "Invalid file";
    }
?>