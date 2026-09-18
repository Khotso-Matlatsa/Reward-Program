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

	 
	 
	 if (isset ($_SESSION['useremail'])){
	$sql= "SELECT * FROM user_info WHERE email = '$useremail' ";	 
	$result = $con->query($sql);
    if (!$result)
    {
    	echo "there was a problem with a query";
    }	 
		
     else{
       $rows = $result->num_rows;
	   $row = $result->fetch_array(MYSQLI_ASSOC);
	   $fullnames = $row['fullnames'];
	   $email = $row['email'];
	   $mobile = $row['mobile'];
	   $referralemail = $row['referralemail'];
      if ($rows == 0)
    {
	     echo "no records available";
    }
	else
	{
		?>
	   
<!DOCTYPE html>

<html>
  <head>
   
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="styles.css">
	<title>responsive</title>
  </head>
  <body>
      
	  
	  <div class="invent">
            
            <h3>Update Profile</h3>
            <form action="userinfo1.php " method="POST">
                  
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
  
  <?php
	}
}
	 	 
		 
	 }
	 

	 