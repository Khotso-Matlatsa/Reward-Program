<?php
	include 'db.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$full_name = $_POST['username'];
		$useremail = $_POST['useremail'];
		
		$dateTime = new DateTime();
		$formattedString = $dateTime->format('Y-m-d H:i:s');
		
		$url = "https://www.quicksolutionsmedia.org";
		
		$referrallink = $url . " " . $useremail . " " . $formattedString;
		echo $referrallink;
		
		

		echo $query = "INSERT INTO `urltable` 
		(`url_id`, `fullnames`, `email`, `referrallink`) 
		VALUES (NULL, '$full_name', '$useremail', '$referrallink')";
		
   		echo $table = mysqli_query($con,$query);
    
		
		mysqli_close($con); // Closing Connection
	}





echo <<<_END

<!DOCTYPE html>
<html>

<head>
      <title>HTML Form</title>
      <link rel="stylesheet" href="styles.css">
	  <script type="text/javascript">
      function myfunction()
      {
	     alert("Url inserted successfully");
      }
    </script>
</head>

<body>
      <div class="invent">
            
            <h3>Test url</h3>
            <form action="testurl.php" method="POST">
                  
                  <input type="text" 
                         id="first" 
                         name="username" 
                         placeholder=" Your names" required>

                  
                  <input type="email"
                         id="email" 
                         name="useremail"
                         placeholder="Email" required>
						 				 
						 
                  <div class="wrap">
                        <button type="submit" name="btn_save"
                                onclick="myfunction()">
                              Submit
                        </button>
                  </div>
            </form>
            
      </div>
</body>

</html>
_END;

?>