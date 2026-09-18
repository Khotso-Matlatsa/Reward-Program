 <?php 
        
$id=$_GET['id']; 
         
include('db.php'); 
         
mysqli_query($con,"delete from `claims` where claim_id='$id'"); 
       header('location:paymentclaim.php'); 
 ?> 