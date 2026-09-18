
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
		$result=mysqli_query($con,"select fullnames,email,mobile,referralemail, password from user_info where email='$useremail'")or die ("query 1 incorrect.......");

		list($fullname,$email,$phone,$referralemail,$user_password)=mysqli_fetch_array($result);

		if(isset($_POST['btn_save'])) 
		{

		$fullname=$_POST['fullnames'];
		$email=$_POST['email'];
		$phone=$_POST['mobile'];
		$referralemail=$_POST['referralemail'];
		$user_password=$_POST['password'];

		mysqli_query($con,"update user_info set fullnames='$fullname', email='$email', mobile='$phone', referralemail='$referralemail', password='$user_password' where email='$useremail'")or die("Query 2 is inncorrect..........");

		header("location: edituser.php");
		mysqli_close($con);
		}

?>
 
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
            <form action=" userinfo1.php" method="POST">
                  
                  <input type="text" 
                         id="first" 
                         name="username" 
                         value="<?php echo $fullname; ?>"  required><br>

                  
                  <input type="email"
                         id="email" 
                         name="useremail"
                         value="<?php echo $email; ?>" required><br>
						 
				 <input type="text"
						 id="phone" 
						 name="userphone"
						 name="mobile" value=""<?php echo $phone; ?>" required><br>
						 
				 <input type="email"
                         id="email" 
                         name="referralemail"
                         value="<?php echo $referralemail; ?>"><br>
						 
				 <input type="password"
                         id="email" 
                         name="password"
                         value="<?php echo $user_password; ?>">
						 					 
						 
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
  
   
  


  
 