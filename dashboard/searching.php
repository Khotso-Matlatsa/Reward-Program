<?php
include 'db.php';


$set=$_POST['search'];
if($set){
	$show="SELECT * FROM user_info where email='$set'";
	$result=mysqli_query($con,$show);
	while ($rows=mysqli_fetch_array($result)){
		echo $rows['user_id'];
		echo $rows['fullnames'];
		echo $rows['email'];
		echo $rows['mobile'];
		echo $rows['referralemail'];
		echo "<br/>";
	}
}
else
{
	echo "nothing was found";
}

echo <<<_END
    <form method="post" action="searching.php">
	    <input type="email" name="search" placeholder="text">
		<input type="submit" name="search" value="search record">
	
	</form>

_END;

?>