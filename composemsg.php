<?php

    // Include config file
   // include "config.php";
 


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
  </head>
  <body> 
      <div id="container"> 
          <div id="chat_box"> 
              <div id="chat_data"> 
              </div>
            </div>
             <form method="post" action="index.php"> 
                 <input type="text" name="name" placeholder="To: " /> 
                 <textarea name="enter message" placeholder="Enter Message: "></textarea> 
                 <input type="submit" name="submit" value="Send." /> 
                </form> 
            </div> 
        </body>


</html>