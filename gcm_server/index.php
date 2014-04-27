<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>

        <link rel="stylesheet" href="docsupport/prism.css">
        <link rel="stylesheet" href="chosen.css">

        <link rel="icon" type="image/png" href="192.168.144.1/order/gcm_server/food.png"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        
        <style type="text/css">
            .chzn-rtl .chzn-drop { left: -9000px; }
            .container{
                width: 950px;
                margin: 0 auto;
                padding: 0;
            }
            h1{
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 24px;
                color: #666;
            }
            h2{
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 18px;
                color: #777;
            }
            h3{
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 16px;
                color: #888;
            }
            h4{
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 22px;
                color: #777;
            }
            h5{
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 14px;
                color: #777;
            }
            div.clear{
                clear: both;
            }
            ul.devices{
                margin: 0;
                padding: 0;
            }
            ul.devices li{
                float: left;
                list-style: none;
                border: 1px solid #dedede;
                padding: 10px;
                margin: 0 15px 25px 0;
                border-radius: 3px;
                -webkit-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.35);
                -moz-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.35);
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.35);
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                color: #555;
            }
            ul.devices li label, ul.devices li span{
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 12px;
                font-style: normal;
                font-variant: normal;
                font-weight: bold;
                color: #393939;
                display: block;
                float: left;
            }
            ul.devices li label{
                height: 25px;
                width: 50px;                
            }
            ul.devices li textarea{
                float: left;
                resize: none;
            }
            ul.devices li .send_btn{
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#0096FF), to(#005DFF));
                background: -webkit-linear-gradient(0% 0%, 0% 100%, from(#0096FF), to(#005DFF));
                background: -moz-linear-gradient(center top, #0096FF, #005DFF);
                background: linear-gradient(#0096FF, #005DFF);
                text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3);
                border-radius: 3px;
                color: #fff;
            }
            body{
            font-family:Arial, Helvetica, sans-serif; 
            font-size:13px;
            }
            .info, .success, .warning, .error, .validation {
            border: 1px solid;
            margin: 10px 0px;
            padding:15px 10px 15px 50px;
            background-repeat: no-repeat;
            background-position: 10px center;
            }
            .info {
            color: #00529B;
            background-color: #BDE5F8;
            background-image: url('info.png');
            }
            .success {
            color: #4F8A10;
            background-color: #DFF2BF;
            background-image:url('192.168.144.1/order/gcm_server/success.png');
            }
            .warning {
            color: #9F6000;
            background-color: #FEEFB3;
            background-image: url('warning.png');
            }
            .error {
            color: #D8000C;
            background-color: #FFBABA;
            background-image: url('http://192.168.144.1/order/gcm_server/error.png');
            }
        </style>
    </head>

    <body bgcolor="#FDFDFD">
        <div class="clear"></div>
        <div id="container" class="container"> 
         <hr/>   
        <h1 align="center"> ADMIN Panel </h1>
            <hr/>  
             <br/>
             <div  id="success" class="success">User successfully added</div>
        <div id="error"class="error">Error adding user</div>
        <br/>
            <ul class="devices">
              <li>
                <h2>Set today's specials:</h2>
                
                    
          <select data-placeholder="Choose special items..." id="select-id" class="chzn-select" multiple style="width:350px;" tabindex="4">
            <option value=""></option>
            <?php
              include_once 'db_functions.php';
              $db = new DB_Functions();
              $items = $db->getAllItems();
              if ($items != false){
                  $no_of_items = mysql_num_rows($items);
              }else{
                  $no_of_items = 0;
                }

              if($no_of_items){
                while ($row = mysql_fetch_array($items)) {
                  echo "<option value=".$row['id'].">".$row['name']."</option>";
                }
              }
            ?>         
          </select>
          <input type="submit" class="send_btn" value="Set" onclick="sendSpecials()"/>

        </li>
    </ul>
        <div class="clear"></div><hr/>
        <br/>
        <ul class="devices">

        <li>

            <h2>Add Users: </h2>
                    <form id ="1001" name="" method="post" onsubmit="return task()">
                        <label>Name: </label> <textarea rows="1" name="name"  style="width:200px;" class="txt_message" placeholder="Darth Vader"></textarea>
                        <div class="clear"></div>
                        <label>Email:</label> <textarea rows="1" name="email" style="width:200px;" class="txt_message" placeholder="vader@empire.com"></textarea>
                        <div class="clear"></div>
                        <label>Pass:</label> <input type="password" class = "txt_message" style="width:200px;"  name="pass" placeholder="Password">
                       <div class="clear"></div>
                        <select id="sel_type" name="type">
                              <option value="type">Select user type</option>
                              <option value="user">User</option>
                              <option value="waiter">Waiter</option>
                              <option value="admin">Admin</option>
                        </select>
                        <input type="submit" class="send_btn" value="Add" onclick=""/>
                    </form>
                </li>
                <li>

            <h2>Add Item: </h2>
                    <form id ="1002" name="" method="post" onsubmit="return addItem()">
                        <label>Name: </label> <textarea rows="1" name="name"  style="width:200px;" class="txt_message" placeholder="Choco lava cake"></textarea>
                        <div class="clear"></div>
                        <label>Desc:</label> <textarea rows="1" name="desc" style="width:200px;" class="txt_message" placeholder="Soft core"></textarea>
                        <div class="clear"></div>
                        <label>Price:</label> <textarea rows="1" name="price" style="width:200px;" class="txt_message" placeholder="250"></textarea>
                       <div class="clear"></div>
                        <select id="sel_cat" name="type">
                              <option value="type">Select category</option>
                              <option value="1">Drinks</option>
                              <option value="2">Starters</option>
                              <option value="3">Main Course</option>
                              <option value="4">Breads</option>
                              <option value="5">Rice</option>
                              <option value="6">Deserts</option>
                        </select>
                        <input type="submit" class="send_btn" value="Add" onclick=""/>
                    </form>
                </li>   
            </ul>
        </div>
        <div class="clear"></div>
        <?php
        include_once 'db_functions.php';
        $db = new DB_Functions();
        $users = $db->getAllUsers();
        if ($users != false)
            $no_of_users = mysql_num_rows($users);
        else
            $no_of_users = 0;
        ?>
        <div class="container">
             <hr/>
            <h4>Send Messages</h4>
            <h3>No of Devices Registered on GCM: <?php echo $no_of_users; ?></h3>
           
            <ul class="devices">

                <?php
                if ($no_of_users > 0) {
                    
                    while ($row = mysql_fetch_array($users)) {
                        ?>
                        <li>
                            <form id="<?php echo $row["id"] ?>" name="" method="post" onsubmit="return sendPushNotification('<?php echo $row["id"] ?>')">
                                <label>Name: </label> <span><?php echo $row["name"] ?></span>
                                <div class="clear"></div>
                                <label>Email:</label> <span><?php echo $row["email"] ?></span>
                                <div class="clear"></div>
                                <div class="send_container">                                
                                    <textarea rows="3" name="title" cols="10" class="txt_message" placeholder="Type title here"></textarea>
                                    <textarea rows="3" name="message" cols="25" class="txt_message" placeholder="Type message here"></textarea>
                                    <input type="hidden" name="regId" value="<?php echo $row["gcm_id"] ?>"/>
                                    <input type="hidden" name="type" value="<?php echo $row["type"] ?>"/>
                                    <div class="clear">
                                    <input type="submit" class="send_btn" style="float: right;" value="Send" onclick=""/>
                                </div>
                            </form>
                        </li>
                    <?php }
                } else { ?> 
                    <li>
                        No Users Registered Yet!
                    </li>
                <?php } ?>
            </ul>
        </div>

        <div class="clear"></div>
        <br/><h5 align="center"> By Omkar Hande<h5>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
        <script src="chosen.jquery.js" type="text/javascript"></script>
         <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#success').hide();
                $('#error').hide();
            });

            function sendPushNotification(id){
                var data = $('form#'+id).serialize();
                $('form#'+id).unbind('submit');                
                $.ajax({
                    url: "send_message.php",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {
                         
                    },
                    success: function(data, textStatus, xhr) {
                          $('.txt_message').val("");

                          $('#success').text("Message sent successfully");
                                     $('#success').show();
                                     setTimeout(function(){
                                         $("#success").fadeOut('slow').wait(3000);
                                      }, 3000);
                                     window.scrollTo(0,0)
                    },
                    error: function(xhr, textStatus, errorThrown) {

                        $('#error').text("Error sending message");
                                     $('#error').show();
                                     setTimeout(function(){
                                         $("#error").fadeOut('slow').wait(3000);
                                      }, 3000);
                         
                    }
                });
                return false;
            }
            var config = {
              '.chzn-select'           : {},
              '.chzn-select-deselect'  : {allow_single_deselect:true},
              '.chzn-select-no-single' : {disable_search_threshold:10},
              '.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
              '.chzn-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
              $(selector).chosen(config[selector]);
            }

            function sendSpecials(){
              
              // var value = $(".chozenSelect").val();
              var value = $("#select-id").chosen().val()
              // alert(String(value));
              // var data = $('form#'+id).serialize();
                        // $('form#'+id).unbind('submit');                
                        $.ajax({
                            url: "set_specials_db.php",
                            type: "GET",
                            data: { sel: String(value) },
                            beforeSend: function() {
                                 
                            },
                            success: function(data, textStatus, xhr) {
                                  $('.txt_message').val("");
                                  $('#success').text("Specials changed");
                                     $('#success').show();
                                     setTimeout(function(){
                                         $("#success").fadeOut('slow').wait(3000);
                                      }, 2000);
                                        },
                            error: function(xhr, textStatus, errorThrown) {
                                 $('#error').text("Error");
                                 $('#error').show();
                                 setTimeout(function(){
                                     $("#error").fadeOut('slow').wait(3000);
                                  }, 2000);
                            }
                        });    
              }
            //   $(document).ready(function(){
            //     $('#success').hide();
            //     $('#error').hide();
            // });
            function addItem(){
                var r=confirm("Are you sure?");
                if (r==true){
                    var data = $('form#'+"1002").serialize();
                // alert(data);
                $('form#'+"1002").unbind('submit');                
                $.ajax({
                    url: "add_item_db.php",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {
                         
                    },
                    success: function(data, textStatus, xhr) {
                          $('.txt_message').val("");
                          $('#sel_cat').val('type');
                          $('#success').text("Item added successfully");
                          $('#success').show();
                          setTimeout(function(){
                             $("#success").fadeOut('slow').wait(3000);
                          }, 2000);
                          
                    },
                    error: function(xhr, textStatus, errorThrown) {
                         $('#error').text("Error adding item");
                         $('#error').show();
                         setTimeout(function(){
                             $("#error").fadeOut('slow').wait(3000);
                          }, 2000);
                    }
                });
                return false;
                }
            }

            function task(){
                var r=confirm("Are you sure?");
                if (r==true){
                    var data = $('form#'+"1001").serialize();
                 // alert(data);
                $('form#'+"1001").unbind('submit');                
                $.ajax({
                    url: "add_user_to_db.php",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {
                         
                    },
                    success: function(data, textStatus, xhr) {
                          $('.txt_message').val("");
                          $('#sel_type').val('type');
                          $('#success').text("User added successfully");
                          $('#success').show();
                          setTimeout(function(){
                             $("#success").fadeOut('slow').wait(3000);
                          }, 2000);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                         $('#error').text("Error adding item");
                         $('#error').show();
                         setTimeout(function(){
                             $("#error").fadeOut('slow').wait(3000);
                          }, 2000);
                    }
                });
                return false;
                }
            }

        </script>

    </body>
</html>