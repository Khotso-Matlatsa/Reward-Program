<?php
 include('db.php'); 
 $id=$_GET['id']; 
 
 
 $get_sql ="select * from `user_info` where user_id='$id'";
  $query=mysqli_query($con,$get_sql);
  
  $row= mysqli_fetch_row($query);
  
  if(isset($_POST['update']))
  {
	  $id=$_GET['user_id'];
      $names=$_POST['names']; 
      $emails=$_POST['email']; 

      $update_sql="update `user_info` set fullnames='$names', email='$emails' where user_id='$id'";	  
	  
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




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>A Simple Admin Dashboard</title>
	
	
	<h1>Update table</h1>
	
	 <form method="POST" action="updates.php"> 
	        <label>ID:</label><input type="hidden" value="<?php echo $row['user_id'];; ?>" name="id"> 
            <label>Names:</label><input type="text" value="<?php echo $row['fullnames']; ?>" name="names"> 
            <label>Email:</label><input type="text" value="<?php echo $row['email']; ?>" name="email"> 
             <input type="submit" name="update"> 
             <a href="inde.php">Back</a> 
         </form> 
	
	</body>
</html>