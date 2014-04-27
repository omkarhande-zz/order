<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Chosen: A jQuery Plugin by Harvest to Tame Unwieldy Select Boxes</title>
  <!-- 
  <link rel="stylesheet" href="docsupport/style.css">
  -->
  <link rel="stylesheet" href="docsupport/prism.css">
  <link rel="stylesheet" href="chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chzn-rtl .chzn-drop { left: -9000px; }
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
  </style>
</head>
<body>

  
    <div id="container" class="container">
      <h1>Choose specials</h1>
      <?php
        echo "<h2> Hey </h2>";
      ?>
       <hr/>
      <div>
        <ul class="devices">
          <li>

       <form>
        <div>
          <label>Choose Items: </label>
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
      </div>

      

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
  <script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
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
      alert(String(value));
      // var data = $('form#'+id).serialize();
                // $('form#'+id).unbind('submit');                
                $.ajax({
                    url: "set_specials_db.php",
                    type: "POST",
                    data: { sel: String(value) },
                    beforeSend: function() {
                         
                    },
                    success: function(data, textStatus, xhr) {
                          $('.txt_message').val("");
                    },
                    error: function(xhr, textStatus, errorThrown) {
                         
                    }
                });    
      }
  </script>
  </form>
  </div>
</body>
</html>
