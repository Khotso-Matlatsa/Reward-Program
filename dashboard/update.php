

<?php
	include('db.php');
	$id=$_GET['id'];
 
	$fullname=$_POST['fullnameS'];
	$email=$_POST['email'];
	$phone=$_POST['mobile'];
	$referral=$_POST['referral'];
	
	
 
	mysqli_query($con,"update `user_info` set fullnames='$fullname', email='$email', mobile'$phone', referralemail='$referral' where user_id='$id'");
	header('location:user.php');
?>