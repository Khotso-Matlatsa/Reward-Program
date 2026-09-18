<?php

	  


 include("db.php");	


$query="select * from user_info";
$result=$con->query($query);



if (!$result){
	die($con->connect_error);
}

$rows=$result->num_rows;

echo <<<_END

<body>
<h1><center>View users records in this page</center></h1>
   <table border="1">
   <tr><th>User ID</th><th>Full names</th><th>Email</th><th>Phone number</th><th>Referral Email</th><th>Delete</th></tr>
   
_END;


for($x=0; $x < $rows; $x++){
	$result->data_seek($x);
	$row= $result->fetch_array(MYSQLI_ASSOC);
	echo '<tr><td>'.$row['user_id'].'</td>'.
	     '<td>'.$row['fullnames'].'</td>'.
		 '<td>'.$row['email'].'</td>'.
		 '<td>'.$row['mobile'].'</td>'.
		 '<td>'.$row['referralemail'].'</td></tr>';

}
echo "</table>
</body>
</html>";
$result->close();
$con->close();

?>
