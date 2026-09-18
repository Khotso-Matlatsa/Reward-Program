<?php



include 'db.php';


if(isset($_POST['btn_save'])) 
{

$email=$_POST['useremail'];
$email = filter_var($email, FILTER_SANITIZE_STRING);

$user_password=md5($_POST['userpassword']); 
$user_password = filter_var($user_password, FILTER_SANITIZE_STRING);



//echo "login details entered are ".$username." - ".$password;



$query="SELECT * FROM admintable WHERE admin_username = '$email' AND adminpassword = '$user_password' ";
$result = mysqli_query($con, $query);


if (mysqli_num_rows($result) == 1){
	$_SESSION['email'] = $email;
	header ("location: portal.php");
}
else{
	 echo "sorry, login was unsuccessful";
}
}

?>