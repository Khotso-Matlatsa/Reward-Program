<?php
require_once 'config.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$Sname=$_POST['names'];
		$Semail=$_POST['email'];
		$Sphone=$_POST['contact'];
		$Snumber=$_POST['survey'];
	
		

		$query = "INSERT INTO `surveyleads` 
		(`surveylead_id`, `surveyorname`, `surveyoremail`, `surveyorphone`, `surveynumber`) 
		VALUES (NULL, '$Sname', '$Semail', '$Sphone', '$Snumber')";
		
   		echo $table = mysqli_query($conn,$query);
    
		if($table){
			echo "query was successful";
		}
		mysqli_close($conn); // Closing Connection
	}
	

	

?>
