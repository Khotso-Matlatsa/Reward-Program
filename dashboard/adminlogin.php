

<!DOCTYPE html>
<html>

<head>
      <title>HTML Login Form</title>
      <link rel="stylesheet" href="styles.css">
</head>

<body>
      <div class="main">
            
            <h3>Log in</h3>
            <form action="login1.php" method="post">
                  
                  <input type="text" 
                         id="first" 
                         name="useremail" 
                         placeholder="Enter email" required>

                  <input type="password"
                         id="password" 
                         name="userpassword"
                         placeholder="Enter Password" required><br>
						 
						 

                  <div class="wrap">
                        <button type="submit"
						        name="btn_save"
                                onclick="solve()">
                              Submit
                        </button>
                  </div>
			
            </form>
            
      </div>
	  
</body>

</html>

