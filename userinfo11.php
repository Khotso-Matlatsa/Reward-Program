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

	include('db.php');

extract($_POST);
if(isset($update))
{
	
   $name = $_POST['username'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['useremail'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $phone = $_POST['userphone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);
   $referral = $_POST['referralemail'];
   $referral = filter_var($referral, FILTER_SANITIZE_STRING);
   
   
   if(empty($name) || empty($email) || empty($phone) || empty($referral))
   
    {
    	echo "<script> alert(' fill all records') </script>";
    }

	else
	{
$sql=mysqli_query($con,"select * from user_info where email='$useremail'");
$r=mysqli_num_rows($sql);
	}
if($r==true)
{


	
	$sql=mysqli_query($con,"update `user_info` set fullnames='$name', email='$email', mobile'$phone', referralemail='$referral' where email='$useremail'");
	
	echo "<script> alert(' Records updated ') </script>";
	header('location:userinfo11.php');
}
	else
	{
	$err="<font color='red'>records not updated</font>";
	}








  echo <<<_END
<!DOCTYPE html>

<html>
  <head>
   
    <!--<title> Responsive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="styles.css">
	<title>responsive</title>
  </head>
  <body>
  
	  <div class="invent">
            
            <h3>Update Profile</h3>
            <form action=" userinfo11.php" method="POST">
                  
                  <input type="text" 
                         id="first" 
                         name="username" 
                         placeholder=" Your names" value="<?php  echo " $fullnames "   ?>" required>

                  
                  <input type="email"
                         id="email" 
                         name="useremail"
                         placeholder="Email" value="<?php  echo " $email "   ?>" required>
						 
				 <input type="text"
						 id="phone" 
						 name="userphone"
						 name="mobile" value="<?php  echo " $mobile "   ?>" >
						 
				 <input type="email"
                         id="email" 
                         name="referralemail"
                         placeholder="Referral email if any" value="<?php  echo " $referralemail "   ?>">
						 
				
						 					 
						 
                  <div class="wrap">
                        <button type="submit" name="update"
                                onclick="solve()">
                              Update
                        </button>
                  </div>
            </form>
            
      </div>
	  

	
  </body>
  </html>
  
   _END;
  
}

  ?>
 