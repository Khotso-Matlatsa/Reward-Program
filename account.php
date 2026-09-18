<?php

include 'db.php';


if(isset($_POST['btn_save'])) 
{

$names=$_POST['username'];
$names = filter_var($names, FILTER_SANITIZE_STRING);
$email=$_POST['useremail'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
$phone=$_POST['userphone'];
$phone = filter_var($phone, FILTER_SANITIZE_STRING);
$referral=$_POST['referralemail'];
$referral = filter_var($referral, FILTER_SANITIZE_STRING);
$user_password=md5($_POST['userpassword']); 
$user_password = filter_var($user_password, FILTER_SANITIZE_STRING);             
$confirm_password=md5($_POST['confirmpass']); 
$confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);                        
$name = "/^[a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";


  
if(empty($names) || empty($email) || empty($phone) || empty($referral) || empty($user_password) ||
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
		if(strlen($user_password) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if(strlen($confirm_password) < 9 ){
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
		if(!(strlen($phone) == 10)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number must be 10 digit</b>
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
		
		$sql = "INSERT INTO `user_info` 
		(`user_id`, `fullnames`, `email`, `mobile`, `referralemail`,
		`password`, `confirmpassword`) 
		VALUES (NULL, '$names', '$email', '$phone', 
		'$referral', '$user_password', '$confirm_password')";
		$run_query = mysqli_query($con,$sql);
		
			if(mysqli_query($con,$sql)){
			echo "register_success";
			
            header ("locatiom: signup.php");
		}
	}
	}

}


echo <<<_END

<!DOCTYPE html>
<html>

<head>
      <title>HTML Form</title>
      <link rel="stylesheet" href="styles.css">
</head>

<body>
      <div class="invent">
            
            <h3>Create Account</h3>
            <form action="account.php" method="POST">
                  
                  <input type="text" 
                         id="first" 
                         name="username" 
                         placeholder=" Your names" required>

                  
                  <input type="email"
                         id="email" 
                         name="useremail"
                         placeholder="Email" required>
						 
                  <input type="number"
                         id="phone" 
                         name="userphone"
                         placeholder="Phone number" required>
						 
				<input type="email"
                         id="email" 
                         name="referralemail"
                         placeholder="Referral email if any" >
						 
				 <input type="password"
                         id="password" 
                         name="userpassword"
                         placeholder="Password" required>	 
				  
                 <input type="password"
                         id="password" 
                         name="confirmpass"
                         placeholder="Confirm Password" required>
						 
			  <p>By creating account, you agree to<a href="careersandterms.php"> terms and conditions</a></p>					 
						 
                  <div class="wrap">
                        <button type="submit" name="subscribe"
                                onclick="solve()">
                              Submit
                        </button>
                  </div>
            </form>
            
      </div>
</body>

</html>
_END;

?>