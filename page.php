
<!DOCTYPE html>
 <html> 
 <head> 
 <style>
 /* Grid styles */
 .grid-container { display: grid; 
 grid-template-columns: repeat(3, 1fr);
 grid-gap: 10px;
 margin-bottom: 20px;
 }
 .grid-item {
	 background-color: #f2f2f2;
	 padding: 10px; 
	 text-align: center; } 
 /* Table styles */ 
 table { 
 border-collapse: collapse; 
 width: 100%;
 } 
 th, td { padding: 8px; text-align: left; 
 border-bottom: 1px solid #ddd;
 } 
 th { background-color: #4CAF50; 
 color: white; 
 }
 /* Pagination styles */ 
 .pagination { display: inline-block;
 } 
 .pagination a { color: black;
 float: left; 
 padding: 8px 16px; 
 text-decoration: none; 
 border: 1px solid #ddd; 
 }
 .pagination a.active { 
 background-color: #4CAF50;
 color: white; 
 border: 1px solid #4CAF50; 
 } 
 .pagination a:hover:not(.active) { 
 background-color: #ddd; } 
 
 </style>
 </head> 
 <body> 
 <?php 
 // Database connection details $servername = "localhost"; 
  
 
 include 'db.php';
 
 // Create connection $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
 // Number of records per page $recordsPerPage = 10; 
 // Current page number 
 
 if (isset($_GET['page'])) { 
 $currentPage = $_GET['page']; } 
 else { $currentPage = 1; } // Calculate the starting record index $startFrom = ($currentPage - 1) * $recordsPerPage; 
 // Fetch student data with pagination
 
 $sql = "SELECT * FROM user_info LIMIT $startFrom, $recordsPerPage"; 
 
 $result = $con->query($sql);
 
 if ($result->num_rows > 0) { // Display student data 
 echo "<div class='grid-container'>";
 echo "<div class='grid-item'><strong>USER ID</strong>< /div>";
 echo "<div class='grid-item'><strong>Name</strong>< /div>";
 echo "<div class='grid-item'><strong>Age</strong>< /div>"; 
 while ($row = $result->fetch_assoc()) {
	 echo "<div class='grid-item'>" . $row["user_id"] . "</div>"; 
	 echo "<div class='grid-item'>" . $row["fullnames"] . "</div>"; 
	 echo "<div class='grid-item'>" . $row["email"] . "</div>"; } 
	 echo "</div>"; } 
	 else { 
	 echo "No records found."; } 
 // Pagination links $sql = "SELECT COUNT(*) AS total FROM studentdata"; 
 $result = $con->query($sql); $row = $result->fetch_assoc();
 $totalRecords = $row["total"];
 $totalPages = ceil($totalRecords / $recordsPerPage); 
 echo "<div class='pagination'>";
 if ($totalPages > 1) { for ($i = 1; $i <= $totalPages; $i++) { 
 if ($i == $currentPage) { 
 echo "<a class='active' href='?page=$i'>$i</a> "; } 
 else {
	 echo "<a href='?page=$i'>$i</a> "; } } }
	 echo "</div>"; 
 // Close the connection $con->close(); ?>
 </body> 
 </html>















