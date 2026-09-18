 <?php 
        
$id=$_GET['id']; 
         
include('db.php'); 
         
mysqli_query($con,"delete from `contacts` where Caller_ID='$id'"); 
       header('location:messages.php'); 
 ?> 