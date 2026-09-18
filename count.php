<?php

  	
session_start ();
if (!isset ($_SESSION['useremail'])){
	header("Location:login.php");
	die();
}
else
{
	$useremail = $_SESSION['useremail'];
}


 include("db.php");	
$sql="SELECT * FROM user_info";
$result=$con->query($sql);

if (!$result){
	die($con->connect_error);
} else
	
	{
	   $rowCount = mysqli_num_rows( $result);	
	}
	printf("total rows in this table : %d\n", $rowCount);


	  


 
 ?>
 
 