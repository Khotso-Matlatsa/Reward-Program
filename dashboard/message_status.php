<?php
	include('db.php');
	
    $id = $_GET['Caller_ID'];
	$status=$_GET['messagestatus'];
	
	
	$sql=mysqli_query($con,"update contacts set status='1' where Caller_ID='$id'");
	
	header('location:admins.php');
	
?>