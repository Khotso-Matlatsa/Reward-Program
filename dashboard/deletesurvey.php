 <?php 
        
$id=$_GET['id']; 
         
include('db.php'); 
         
mysqli_query($con,"delete from `surveyleads` where surveylead_id='$id'"); 
       header('location:softwaretask.php'); 
 ?> 