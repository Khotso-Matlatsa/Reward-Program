<?php
require_once __DIR__ . '/config.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$names=$_POST['names'];
		$emails=$_POST['emails'];
		$contacts=$_POST['phones'];
		$rewardtype=$_POST['rewardtype'];
		$paymentmethod=$_POST['paymentmethod'];
		$status=$_POST['claimstatus'];

	
		

		$query = "INSERT INTO `claims` 
		(`claim_id`, `claimantname`, `claimantemail`, `claimantcontacts`, `rewardtype`, `paymentmethod`, `status`) 
		VALUES (NULL, '$names', '$emails', '$contacts', '$rewardtype', '$paymentmethod', '$status')";
		
   		echo $table = mysqli_query($conn,$query);
    
		if($table){
			echo "query was successful";
			header("location:rewardsclaim.php");
		}
		mysqli_close($con); // Closing Connection
	}
	

	

?>
