<?php 
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // FIXED FIELD NAMES
    $name = trim($_POST['fullnames'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $company = trim($_POST['companyname'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($name) || empty($email) || empty($description)) {
        $error = "Please fill required fields";
    } else {

        $stmt = $conn->prepare("
            INSERT INTO quotations (name, email, company, phone, description, status)
            VALUES (?, ?, ?, ?, ?, 0)
        ");

        $stmt->bind_param("sssss", $name, $email, $company, $phone, $description);
        
        if ($stmt->execute()) {

            // ✅ REDIRECT FIX
            header("Location: admin_quotations.php?success=1");
            exit();

        } else {
            $error = "Database error!";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Quotation</title>
</head>

   <style>
		$teal:#00b4cf;
		$white:#ffffff;

		@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

		* {
		  box-sizing:border-box;
		  margin:0;
		}

		body {
			background: white;//linear-gradient(90deg, #BE8CEF 0%, rgba(61, 46, 232, 0.83) 100%);
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			font-family: 'Montserrat', sans-serif;
		  font-size:10px;
			height: 100vh;
			margin: -20px 0 50px;
		}

		.container {
			background-color: $white;
			border-radius: 5px;
		box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
					0 10px 10px rgba(0,0,0,0.22);
			position: relative;
			overflow: hidden;
			width: 768px;
			max-width: 100%;
			min-height: 512px;
		  min-width:370px;
		}

		h2 {
		  font-size:2rem;
		  margin-bottom:1rem;
		}
		.form-container {
		  display:flex;
		}

		.left-container {
		  flex:1;
		  height:480px;
		  background-color:$teal;
		}
		.right-container {
		  display:flex;
		  flex:1;
		  height:460px;
		  background-color: $white;
		  justify-content:center;
		  align-items:center;
		}
		.left-container {
		  display:flex;
		  flex:1;
		  height:480px;
		  justify-content:center;
		  align-items:center;
			color:$white;
		}

		.left-container p {
		  font-size:0.9rem;
		}

		.right-inner-container {
		  width:70%;
		  height:80%;
		  text-align:center;
		}

		.left-inner-container {
		  height:50%;
		  width:80%;
		  text-align:center;
		  line-height:22px;
		}

		input, textarea {
			background-color: #eee;
			border: none;
			padding: 12px 15px;
			margin: 8px 0;
			width: 100%;
		  font-size:0.8rem;
		}

		input:focus, textarea:focus{
		  outline:1px solid $teal;
		}
		button {
			border-radius: 20px;
			border: 1px solid #00b4cf;
			background-color: #00b4cf;
			color: #FFFFFF;
			font-size: 12px;
			font-weight: bold;
			padding: 12px 45px;
			letter-spacing: 1px;
			text-transform: uppercase;
			transition: transform 80ms ease-in;
		  cursor:pointer;
		}

		button:hover {
		  opacity:0.7;
		}
		@media only screen and (max-width: 600px) {
		  .left-container{
			display: none;
		  }
		  .lg-view {
			display:none;  
		  }
		}

		@media only screen and (min-width: 600px) {
		  .sm-view {
			display:none;  
		  }
		}

		form p {
		  text-align:left;
		}

   
   
   </style>

<body>
    <div class="container">
  <div class="form-container">
    <div class="left-container">
      <div class="left-inner-container">
      <h2>Let's Talk</h2>
      <p>If you have a project you want to start or an existing business, we are ready to provide you with the best services to help your bususiness prosper.</p>
        <br>
        <p>Feel free to request quotation from us</p>
    </div>
      </div>
    <div class="right-container">
      <div class="right-inner-container">
        <form action="quotation.php" method="post">
			<h2 class="lg-view">Quotation form</h2>
      <h2 class="sm-view">Talk to us</h2>
           <p>* Required</p>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
            <input type="text" name="fullnames" placeholder="Names *" required />
            <input type="email" name="email" placeholder="Email *" required />
			<input type="text" name="companyname" placeholder="Company" />
			<input type="phone" name="phone" placeholder="Phone" />
            <textarea rows="4" name="description" placeholder="Description *" required></textarea>
		    <input type="hidden" name="quotationstatus" value="0">
			<button type="submit" name="submit_quote">SUBMIT</button>
		</form>
      </div>
    </div>
  </div>
</div>



</body>
</html>