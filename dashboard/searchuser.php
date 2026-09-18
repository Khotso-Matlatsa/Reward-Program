<!DOCTYPE html>
<html>

<head>
      <title>HTML Form</title>
      <link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php
	
		
 			
	include("db.php");
	$Valuetosearch = $_POST['valuetosearch'];
	$query=" SELECT * FROM user_info WHERE email = '$Valuetosearch'" ;
	
	$result=mysqli_query($con,$query);
	?>
	<?php
	  if ($result)
	  {
		  while($row = mysqli_fetch_array($result))
		  {
			  
	?>
	

<form action="searchuser.php" method="post">
	<input type="text" name="valuetosearch" placeholder="Search Record">
	<input type="submit" name="search" value="search record">
</form>
	
	<table border="2" cellpadding="10">
	 <tr>
		 <th> User ID </th>
		 <th> Names </th>
		 <th> Email </th>
		 <th> phone_number </th>
		 <th> Referral Email </th>
		 
	 </tr>




	 <tr>
	    <td><?php echo $row["user_id"]; ?></td>
		<td><?php echo $row["fullnames"]; ?></td>
		<td><?php echo $row["email"]; ?></td>
		<td><?php echo $row["mobile"]; ?></td>
		<td><?php echo $row["referralemail"]; ?></td>
	 </tr>
	<?php
	}
	}
	?>
	</table>
	
	</body>

</html>