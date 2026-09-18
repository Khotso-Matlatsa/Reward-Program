 <?php 
        
$id=$_GET['id']; 
         
include('db.php'); 

     $filename=$_POST['filename'];
	  $folder= "uploads/";
	  
	  if ($dir = opendir($folder)){


         
mysqli_query($con,"delete from `files` where file_id='$id'"); 


unlink('uploads/'.$filename);


       header('location:content.php'); 
	  }
 ?> 
 
 
 
 
 
 
 