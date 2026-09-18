 <?php 
        
$id=$_GET['id']; 
         
include('db.php'); 
         
mysqli_query($con,"delete from `job` where job_ID='$id'"); 
       header('location:career.php'); 
 ?> 