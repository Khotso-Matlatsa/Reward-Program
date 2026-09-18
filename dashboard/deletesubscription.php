 <?php 
        
$id=$_GET['id']; 
         
include('db.php'); 
         
mysqli_query($con,"delete from `emailtable` where email_id='$id'"); 
       header('location:emailsubscriptions.php'); 
 ?> 