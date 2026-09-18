 <?php 
        
$id=$_GET['id']; 
         
include('db.php'); 
         
mysqli_query($con,"delete from `user_info` where user_id='$id'"); 
       header('location:inde.php'); 
 ?> 