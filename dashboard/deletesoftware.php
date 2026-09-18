 <?php 
        
$id=$_GET['id']; 
         
include('db.php'); 
         
mysqli_query($con,"delete from `softwaretasks` where softwaretask_id='$id'"); 
       header('location:softwaretask.php'); 
 ?> 