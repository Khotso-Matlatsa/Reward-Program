 <?php 
  include('db.php');       
$id=$_GET['id']; 
         

         
mysqli_query($con,"delete from `contacts` where caller_ID='$id'"); 
       header('location:inde.php'); 
 ?> 