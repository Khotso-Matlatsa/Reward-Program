
<?php
include('db.php');

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$Tasktitle = $_POST['Surveytitle'];
		$Businessname = $_POST['Businessname'];
		$Description = $_POST['surveydescription'];
		$Linktosurvey = $_POST['surveylink'];
		$deadline = $_POST['completeby'];
		

		$query = "INSERT INTO `tasks` 
		(`task_id`, `title`, `businessname`, `description`, `surveylink`,
		`deadline`) 
		VALUES (NULL, '$Tasktitle', '$Businessname', '$Description', 
		'$Linktosurvey', '$deadline')";
		
   		echo $table = mysqli_query($con,$query);
    
		if($table){
			echo "query was successful";
		}
		mysqli_close($con); // Closing Connection
	}
	

	
?>


	