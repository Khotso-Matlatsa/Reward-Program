
<?php
include('db.php');

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$names = $_POST['username'];
		$email = $_POST['useremail'];
		$phone = $_POST['userphone'];
		$referral = $_POST['referralemail'];
		
	    $user_password = md5($_POST['userpassword']);
		$confirm_password=md5($_POST['confirmpass']);
		$name = "/^[a-zA-Z ]+$/";
        $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
        $number = "/^[0-9]+$/";
		
		
		  
if(empty($names) || empty($email) || empty($phone) || empty($user_password) ||
	empty($confirm_password)){
		
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	}
	 else {
		if(!preg_match($name,$names)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $names is not valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid..!</b>
			</div>
		";
		exit();
	}
		if(strlen($user_password) < 7 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if(strlen($confirm_password) < 7 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if($user_password != $confirm_password){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>passwords do not match</b>
			</div>
		";
	}
	if(!preg_match($number,$phone)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number $phone is not valid</b>
			</div>
		";
		exit();
	}
	
	//existing email address in our database
	$sql = "SELECT user_id FROM user_info WHERE email = '$email' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Email address already available, Try Another one</b>
			</div>
		";
		exit();
	}
	else {
		
		
		
		

		$query = "INSERT INTO `user_info` 
		(`user_id`, `fullnames`, `email`, `mobile`, `referralemail`,
		`password`, `confirmpassword`) 
		VALUES (NULL, '$names', '$email', '$phone', 
		'$referral', '$user_password', '$confirm_password')";
		
   		echo $table = mysqli_query($con,$query);
		
	}
		
		
		
		
		
		
		
    
		if($table){
			echo "query was successful";
			header ("location: signup.php");
		}
		mysqli_close($con); // Closing Connection
	}
	}
?>


	
































  