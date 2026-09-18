<?php
session_start();
if (!isset($_SESSION['username'])){
	header("Location: login.php");
	die();
}
else{
	$username = $_SESSION['username'];
}

?>


	<?php echo "<p>Welcome $username </p>"?>
	
	<?php echo "<br><a href='logout.php'><input type=button value=logout name=logout></a>";?>
	  

<?php

include('db.php'); 

$query=" SELECT surveylink FROM tasks WHERE task_id IN (1, 2)";
$result=$con->query($query);

if (!$result){
	die($con->connect_error);
}

$rows=$result->num_rows;

echo <<<_END


<!DOCTYPE html>
<html>
<head>
    <title>web development</title>
	<link href=" " rel="stylesheet"/>
	
</head>

<body>
<p id="middle"><center>Check for messages records in this page</center></p>
   <table border="1">
   <tr><th>MESSAGE ID</th><th>PHONE NUMBER</th></tr>
   
_END;

for($x=0; $x < $rows; $x++){
	$result->data_seek($x);
	$row= $result->fetch_array(MYSQLI_ASSOC);
	echo '<tr><td>'.$row['surveylink'].'</td>'.
		 '<td>'.$row['surveylink'].'</td></tr>';
}
echo "</table>
</body>
</html>";
$result->close();
$con->close();

?>
echo <<<_END

   <section>
      <div class="row">
        <h2 class="section-heading">Surveys</h2>
      </div>
      <div class="row">
        <div class="column">
          <div class="card">
            
            <h3>Survey 1</h3>
            <p>

             <?php echo "<h1>" . $row["surveylink"]. "</h1>"; ?>
		        
            </p>
          </div>
        </div>
        <div class="column">
          <div class="card">

            <h3>Survey 2</h3>
            <p>

              <?php echo $surveylink;?>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="card">
            
            <h3>Survey 3</h3>
            <p>

             <?php echo $surveylink;?>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="card">
            
            <h3>Survey 4</h3>
            <p>

              <?php echo $surveylink;?>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="card">
            
            <h3>Survey 5</h3>
            <p>
              
              <?php echo $surveylink;?>
            </p>
          </div>
        </div>
        <div class="column">
          <div class="card">
            
            <h3>Survey 6</h3>
            <p>
             <?php echo $surveylink;?>
             
            </p>
          </div>
        </div>
      </div>
    </section>
	

	
		</body>


