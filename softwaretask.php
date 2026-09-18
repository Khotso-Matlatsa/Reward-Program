
<?php
include('db.php');

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$Softwaretitle = $_POST['softwaretitle'];
		$Businessname = $_POST['businessname'];
		$Softwaredescription = $_POST['softwaredescription'];
		$Softwarelink = $_POST['softwarelink'];
	
		

		$query = "INSERT INTO `softwaretasks` 
		(`softwaretask_id`, `softwaretitle`, `businessname`, `softwaredescription`, `softwarelink`) 
		VALUES (NULL, '$Softwaretitle', '$Businessname', '$Softwaredescription', '$Softwarelink')";
		
   		echo $table = mysqli_query($con,$query);
    
		if($table){
			echo "query was successful";
		}
		mysqli_close($con); // Closing Connection
	}
	

	

	echo <<<_END
	             <form action="softwaretask.php" method="post">
				   <input type="text" name="softwaretitle" placeholder="software title" required>
				   <input type="text" name="businessname" placeholder="Business name" required>
				   <input type="text" name="softwaredescription" placeholder="software description" required>
				   <input type="text" name="softwarelink" placeholder="software link" required>
				    
				   <button type="submit" name="btn_save" onclick="myfunction()">Send</button>
				   </form>
	
	
	_END;
?>

