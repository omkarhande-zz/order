<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>
        
        <link rel="icon" type="image/png" href="192.168.144.1/order/gcm_server/food.png"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#success').hide();
                $('#error').hide();
            });
            function task(){
                var r=confirm("Are you sure?");
                if (r==true){
                    var data = $('form#'+1).serialize();
                // alert(data);
                $('form#'+1).unbind('submit');                
                $.ajax({
                    url: "add_user_to_db.php",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {
                         
                    },
                    success: function(data, textStatus, xhr) {
                          $('.txt_message').val("");
                          $('#sel_type').val('type');
                          $('#success').show();
                          $('#errow').hide();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                         $('#success').hide();
                         $('#error').show();
                    }
                });
                return false;
                }
            }
            
        </script>
        <style type="text/css">
            .container{
                width: 950px;
                margin: 0 auto;
                padding: 0;
            }
            h1{
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 24px;
                color: #777;
            }
            h2{
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 18px;
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

    <body>
        <div class="container">
            <h1>ADD USER <a href="http://192.168.144.1/order/gcm_server/" style="color: #999;">SEND MESSAGE</a></h1>
            <h2>Add customers, waiters or admins</h2>
            <hr/>
            <ul class="devices">
                     <li>
                    <form id = 1 name="" method="post" onsubmit="return task()">
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
                    
            </ul>
        </div>
        <div class="clear"></div>

        <div  id="success" class="success">User successfully added</div>
        <div id="error"class="error">Error adding user</div>
    </body>
</html>