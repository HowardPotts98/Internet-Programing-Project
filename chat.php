<?php 

include 'db.php';
 $query = "SELECT * FROM chat ORDER BY username"; 
 $run = $con->query($query); 
 while($row = $run->fetch_array()) : ?>


 <div id="chat_data"> 
     <span style="color:pink;"><?php echo $row['username']; ?> : </span> 
     <span style="color:black;"><?php echo $row['msg']; ?></span> 
     <span style="float:right;"><?php echo $row['date']; ?></span> 
    </div> 
    <?php endwhile; ?>
