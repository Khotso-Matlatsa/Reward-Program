
<?php

include('db.php'); 

if (isset($_POST['submit']))
     
{   
      $filename=$_POST['filename'];
	  $folder= "uploads/";
	  
	  if ($dir = opendir($folder)){
     
	 //$filesname=$_FILES['filename']['name'];
	
	 //$destination='filing/'.$filename;
	 
	   //deleting values
	   $query = "DELETE FROM files WHERE filename = '$filename'";
	   $result = $con->query($query);
	   //unlink("$destination/$filename");
	   //unlink(filing//);
	   //unlink($_POST[filing/]);
	   unlink('uploads/'.$filename);
	   header("location:content.php");
	   
	   //if(!$result)echo "delete failed: $query<br> ".
	   //$conn->error."<br><br>";
	  }

}
?>





	
	  