<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>A Simple Admin Dashboard</title>
</head>
    <style>
	  .grid-container{
	    diplay: grid;
		grid-template-columns: repeat(3, 1fr);
		grid-gap: 10px;
		margin-bottom: 20px;
	  }
	  .grid-item{
	    background-color: #f2f2f2;
		padding: 10px;
		text-align: center;
	  }
	  table{
	    border-collapse: collapse;
		width: 100%;
		
	  }
	  th,td{
	    padding:8px; 
		text-align: left;
		border-bottom: 1px solid #ddd;
		
	  }
	  th{
	    background-color: #4CAF50;
		color: white;
	  }
	  .pagination{
	    display: inline-block;
	  }
	  .pagination a{
	    color: black; 
		float: left;
		padding: 8px 16px;
		text-decoration: none;
		border: 1px solid #ddd;
	  }
	  .pagination a.active{
	    background-color: #4CAF50;
		color: white;
		border: 1px solid #4CAF50;
	  }
	  .pagination a:hover:not(.active){
	     background-color: #ddd;
	  }
	
	</style>
	
	<head>
	</body>
	
	<?php
	    include("db.php");
		//number of records per page
		$recordsPerPage=3;
		//current page number
		if (isset($_GET['page']))
		{
		   $currentPage = $_GET['page'];
		   
		} else{
		   $currentPage = 1;
		}
		//calculate the starting record index
		
		$startFrom = ($currentPage - 1) * $recordsPerPage;
		
		//fetch user data with pagination
		
		$sql = "SELECT * FROM user_info LIMIT $startFrom, $recordsPerPage";
		$result = $con->query($sql);
		
		if ($result->num_rows > 0) {
		//display student data
		echo "<div class='grid-container'>";
		echo "<div class='grid-item'><strong>User ID</strong></div>";
		echo "<div class='grid-item'><strong>Full names</strong></div>";
		echo "<div class='grid-item'><strong>Email</strong></div>";
		echo "<div class='grid-item'><strong>Mobile phone</strong></div>";
		echo "<div class='grid-item'><strong>Referral email</strong></div>";
		
		while ($row = $result->fetch_assoc()){
		   echo "<div class='grid-item>" . $row["user_id"] . "</div>";
		   echo "<div class='grid-item>" . $row["fullnames"] . "</div>";
		   echo "<div class='grid-item>" . $row["email"] . "</div>";
		   echo "<div class='grid-item>" . $row["mobile"] . "</div>";
		   echo "<div class='grid-item>" . $row["referralemail"] . "</div>";
		}
		
		echo "</div>";
		} else {
		   echo "no records found.";
		   
		   }
		   //pagination links
		   $sql = "SELECT COUNT (*) AS total FROM user_info";
		   $result  = $con->query($sql);
		   $row = $result->fetch_assoc();
		   $totalRecords = $row["total"];
		   $totalPages = ceil($totalRecords / $recordsPerPage);
		   
		   echo "<div class='pagination'>";
		   
		   if ($totalPages > 1) {
		   for  ($i = 1; $i <= $totalPages; $i++) {
		   if ($i == $currentPage) {
		   echo "<a class='active'href='?page=$i'>$i</a> ";
		   } else {
		   echo "<a href='?page=$i'>$i</a> ";
		   }
		  }
		 }
		
		
		
		
		 echo "</div>";
		 
		 $con->close();
		
	
	
	?>
	
	</body>
  </html>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	