
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

header("location: dashboard2.php");
mysqli_close($con);
}

?>

  
	
	
	
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
        <div class="col-md-5 mx-auto">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Edit User</h5>
              </div>
              <form action="edituser.php" name="form" method="post" >
              <div class="card-body">
                
                
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label>Full names</label>
                        <input type="text" id="first_name" name="fullnames"  class="form-control" value="<?php echo $fullname; ?>" >
                      </div>
                    </div>
					<div class="col-md-12 ">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email"  id="email" name="email" class="form-control" value="<?php echo $email; ?>">
                      </div>
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label>Phone number</label>
                        <input type="number" id="phone" name="mobile" class="form-control" value="<?php echo $phone; ?>" >
                      </div>
                    </div>
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Referral Email address</label>
                        <input type="email"  id="email" name="referralemail" class="form-control" value="<?php echo $referralemail; ?>">
                      </div>
                    </div>
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label >Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="<?php echo $user_password; ?>">
                      </div>
                    </div>
                  
                  
                  
                
              </div>
              <div class="card-footer">
                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update</button>
              </div>
              </form>    
            </div>
          </div>
         
          
        </div>
      </div>
  