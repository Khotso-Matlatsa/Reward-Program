 <?php 
        
$id=$_GET['id']; 
         
include('db.php'); 
         
mysqli_query($con,"delete from `tblquotation` where quotationid='$id'"); 
       header('location:checkquotation.php'); 
 ?> 