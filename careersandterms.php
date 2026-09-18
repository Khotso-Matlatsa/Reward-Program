<?php
	


echo <<<_END


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column2 {
  float: left;
  width: 50%;
  padding: 10px;
  height: 700px; /* Should be removed. Only for demonstration */
  
}

/* Clear floats after the columns */
.row2:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column2 {
    width: 100%;
  }
}
/****contact form****/
.footer-section2 form {
		    display: flex;
			flex-direction: column;
		}
		.footer-section2 form 
		    input[type="email"]{
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			background-color: #555;
			color: #fff;
			cursor: pointer;
			width: 60%;
		}
		 input[type="text"]{
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			background-color: #555;
			color: #fff;
			cursor: pointer;
			width: 60%;
		}
		.footer-section2 form button:hover{
		  background-color: #777;
		}
		.footer-section2 form button{
		  width: 60%;
		}


</style>
</head>
<body>


<div class="row2">

  <div class="column2" style="background-color:#aaa;">
    <h2>Check our job posts here</h2>
	

	
	
	
	
	
    
	
	<div class="footer-section2">

				  <h3>no job posts from our company currently</h3>
				   </div>
            
            
  </div>
  <div class="column2" style="background-color:#bbb;">
  <h2>Please note this: by signing up, you agree to terms and conditions stated below</h2>
    <h4>1. You can only have one account registered, no more than one account for a single user.</h4>
    <h4>2. You agree to receive marketing updates from QuickSolutions Media via email, SMS and other social media platforms </h4>
	<h4>3. Your registration information may be shared with third-parties for marketing purposes </h4>
	<h4>4. Should you enter wrong registration information, QuickSolutions Media will not take responsibility for your lost funds </h4>
	<h4>5. QuickSolutions Media reserves a right to hold you responsible or ban you for any misuse of its platforms </h4>
	<h4>6. You can only claim rewards after completing all tasks stated  </h4>
	<h4>7. QuickSolutions Media will not be responsible for any harm caused by software downloaded under its platforms </h4>

	
  </div>
</div>

</body>

_END; ?>

</html>