<?php 
         include('db.php'); 
        $id=$_GET['id']; 
       $query=mysqli_query($con,"select * from `user_info` where user_id='$id'"); 
       $row=mysqli_fetch_array($query); 
 ?> 
 
 
 
 
 <!DOCTYPE html> 
 <html> 
 <head> 
 <title>Basic MySQLi Commands</title> 
 </head> 
 <body> 
        <h2>Edit</h2> 
       <form method="post" action="update.php?id=<?php echo $id; ?>"> 
	        <label>ID:</label><input type="hidden" value="<?php echo $row['user_id']; ?>" name="id"> 
            <label>Names:</label><input type="text" value="<?php echo $row['fullnames']; ?>" name="names"> 
            <label>Email:</label><input type="text" value="<?php echo $row['email']; ?>" name="emails"> 
			 <label>Phone Number:</label><input type="text" value="<?php echo $row['mobile']; ?>" name="names"> 
            <label>Referral Email:</label><input type="text" value="<?php echo $row['referral']; ?>" name="emails"> 
             <input type="submit" name="submit"> 
             <a href="user.php">Back</a> 
         </form> 
 </body> 
 </html> 