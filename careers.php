<?php

include 'db.php';
if(isset($_POST['btn_save'])) 
{


$positions=$_POST['position'];
$position= filter_var($positions, FILTER_SANITIZE_STRING);
$requirement=$_POST['requirements'];
$requirement = filter_var($requirements, FILTER_SANITIZE_STRING);
$positionnumber=$_POST['positionsnumber'];
$positionnumbers = filter_var($positionnumber, FILTER_SANITIZE_STRING);
$emailto=$_POST['emailto'];
$emailto = filter_var($emailto, FILTER_SANITIZE_STRING);
$jobtype=$_POST['jobtype'];
$jobtype = filter_var($jobtype, FILTER_SANITIZE_STRING);
$applydate=$_POST['applydate'];
$applydate = filter_var($applydate, FILTER_SANITIZE_STRING);
$name = "/^[a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";

if(empty($positions) || empty($emailto) || empty($positionsnumber) || empty($requirements) || empty($applydate) || empty($jobtype)){
		
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	}
	 else {
		if(!preg_match($name,$positions)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $positions is not valid..!</b>
			</div>
		";
		exit();
	}
		if(!preg_match($name,$requirement)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $requirement is not valid..!</b>
			</div>
		";
		exit();
	}
		if(!preg_match($name,$jobtype)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $jobtype is not valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($emailValidation,$emailto)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $emailto is not valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($number,$positionnumber)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Position number $positionnumber is not valid</b>
			</div>
		";
		exit();
	}
	
	else {
		
		$sql = "INSERT INTO `jobs` 
		(`job_ID`, `position`, `requirements`, `positionnumber`  ,`emailto`, `jobtype`, `applydate`) 
		VALUES (NULL, '$positions', '$requirement', '$positionnumber', '$emailto', '$jobtype', '$applydate')";
		$run_query = mysqli_query($con,$sql);
		
			if(mysqli_query($con,$sql)){
			echo "Job position posted";
			
            exit;
		}
	}
	
	
	 }	
}



<style>

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
			background-color: black;
			color: #fff;
			cursor: pointer;
			width: 20%;
		}
		 input[type="text"]{
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			background-color: black;
			color: #fff;
			cursor: pointer;
			width: 20%;
		}
		input[type="number"]{
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			background-color: black;
			color: #fff;
			cursor: pointer;
			width: 20%;
		}
		input[type="datetime-local"]{
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			background-color: black;
			color: #fff;
			cursor: pointer;
			width: 20%;
		}
		.jobtype{
			padding: 10px;
			margin-bottom: 10px;
			border: none;
			border-radius: 5px;
			background-color: black;
			color: #fff;
			cursor: pointer;
			width: 21%;
		}
		.footer-section2 form button:hover{
		  background-color: #777;
		}
		.footer-section2 form button{
		  width: 21%;
		}

/****contact form****/
	


</style>
echo <<<_END

	<div class="footer-section2">

				   <form action="careers.php" method="post">
				   <input type="text" name="position" placeholder="Position" required>
				   <input type="text" name="requirements" placeholder="requirement 1,2...." required>
				   <input type="number" name="positionsnumber" placeholder="Number of positions" required>
				   <input type="email" name="emailto" placeholder="Email applications to..." required>
				   <label for=""><select name="jobtype" class="jobtype">
				   <option>Job Type</option>
			       <option>Full-time</option>
			       <option>Part-time</option>
			       <option>internship</option>
			       </td>
			    </select></label>
				   <input type="datetime-local" name="applydate" placeholder="Send applications to..." required>
				   
				   <button type="submit" name="btn_save">Post</button>
				   </form>
				   </div>
            
            
  </div>




	</body>
	
</html>
	
	_END;
	
	?>