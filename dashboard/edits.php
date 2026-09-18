<?php 
         include('db.php'); 
		 error_reporting(0);
        $id=$_GET['user_id']; 
		$fullname=$_GET['names']; 
		$emails=$_GET['email'];

		
 ?> 
 <!DOCTYPE html> 
 <html> 
 <head> 
 <title>Basic MySQLi Commands</title> 
 </head> 
 <body> 
        <h2>Edit</h2> 
       <form method="GET" action=""> 
	        <label>User id:</label><input type="text" value="<?php echo $id; ?>" name="user_id"> 
            <label>Names:</label><input type="text" value="<?php echo $fullname ?>" name="names"> 
            <label>Email:</label><input type="text" value="<?php echo $emails ?>" name="email"> 
             <input type="submit" name="submit"> 
             <a href="inde.php">Back</a> 
         </form> 
 </body> 
 </html> 
 
 
 <?php
     
	 if($_GET['submit'])
	 {
		 $id=$_GET['user_id']; 
		 $fullname=$_GET['names']; 
		$emails=$_GET['email'];
		
		$query="update `user_info` set fullnames='$fullname', email='$emails' where user_id='$id'";
		
		$data = mysqli_query($con, $query);
		
		if($data)
		{
			echo "<script>alert('Record updated')</script>";
		}
		else
		{
			echo "failed to update record";
		}
	 }
 
 ?>