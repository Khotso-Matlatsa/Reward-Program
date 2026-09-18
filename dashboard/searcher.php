<?php
include 'db.php';


$set=$_POST['search'];
if($set){
	$show="SELECT * FROM user_info where email='$set'";
	$result=mysqli_query($con,$show);
	
	
	echo "<table border='1'>";
	echo "<tr><th>user id</th><th>full names</th><th>email</th><th>phone number</th><th>referral email</th></tr>";
	
	
	while ($rows=mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" . $rows['user_id']. "</td>";
		echo "<td>" . $rows['fullnames']. "</td>";
		echo "<td>" . $rows['email']. "</td>";
		echo "<td>" . $rows['mobile']. "</td>";
		echo "<td>" . $rows['referralemail']. "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo "nothing was found";
}
$con->close();
echo <<<_END
    <form method="post" action="searcher.php">
	    <input type="email" name="search" placeholder="text">
		<input type="submit" name="search" value="search record">
	
	</form>

_END;

?>