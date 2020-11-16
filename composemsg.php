<?php

    // Include config file
    include "config.php";
 


?>



<!-- Creating the messaging interface -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="msgstyles.css" />
    <title>Compose a New Message</title>

    <!-- 

    <script>
         function chat_ajax() { 
              var req = new XMLHttpRequest(); 
              req.onreadystatechange = function() { 
                      if(req.readyState == 4 && req.status == 200) { 
                            document.getElementById('msgchat').innerHTML = req.responseText; 
                            }
                       } 
                       req.open('GET', 'chat.php', true); 
                       req.send();
          } 
          
          setInterval(function(){chat_ajax()}, 1000) 
    </script>
  -->


  </head>
  <body> 
      <div id="container"> 
          <div id="chat_box"> 
          <?php 
          $query = "SELECT * FROM msgchat ORDER BY username"; 
          $run = $con->query($query); 
          while ($row = $run->fetch_array()) : ?>

              <div id="chat_data"> 
              <span style="color:pink;"><?php echo $row['username']; ?> : </span> 
              <span style="color:black;"><?php echo $row['msg']; ?></span> 
              <span style="float:right;"><?php echo $row['date']; ?></span>

              </div>
            <?php endwhile; ?>
            </div>


             <form method="post" action="composemsg.php"> 
                 <input type="text" name="name" placeholder="To: " /> 
                 <textarea name="enter message" placeholder="Enter Message: "></textarea> 
                 <input type="submit" name="submit" value="Send." /> 
                </form> 

            </div> 
        </body>
</html>