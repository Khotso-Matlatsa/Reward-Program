<?php
session_start ();
if (!isset ($_SESSION['useremail'])){
	header("Location:login.php");
	die();
}
else
{
	$useremail = $_SESSION['useremail'];
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scroll percent: 0%</title>
		
	</head>
    <body>
<style>
   body{
     height: 2000px;
	 font-family: sans-serif;
	 margin: 0;
   }
   h1{
      position: fixed;
	  top: 20px;
	  left: 20px;
	  background-color: #f1f1f1;
	  padding: 10px;
	  border-radius: 5px;
	  z-index: 1000;
	  
   }
   
   
table{
	border:2;
	color: black;
}
th, td{
	padding:8px;
	text-align:center;
}
table th{
	background:green;
}
table, th, td{
	border: thin solid black;
}
img {
	width:100px;
	height:120px;
}
</style>

<h2 id="scrollPercentage"> 0%</h2><br><br>


<table style="width: 50%">
		<tr>
		<th style="text-align:center" colspan="10"><?php echo "<h1> Shoprite products & services</h1>"?> </th>
		</tr>
	

<?php

	include('db.php'); 
	$query = "SELECT * FROM businesses WHERE businessname='picknpay'";
	$result = $con->query($query);
	if(!$result){
		echo "There was an error ";
	}
	$rows = $result->num_rows;
	
	
	for($x = 0; $x < $rows; $x++){
		
		$result->data_seek($x);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		echo '<tr> 
				
				<td><img src=\'dashboard\products\\'.$row['filename'].'\'><br><b>'. $row['sellingprice']. ' 	</b><div class="like-container"><button class="like-button"<span class="material-icons">Like</span></button><span class="like-count">0</span></div>                       </td>
				
				</tr>';
		
	}
	
?>
</table>


<script>
const scrollDisplay = document.getElementById('scrollPercentage');
let timeout = null;


     window.addEventListener('scroll', function(){
	   const scrollTop = document.documentElement.scrollTop;
       const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
       const scrollPercentage = (scrollTop / scrollHeight) * 100;
       document.getElementById('scrollPercentage').innerText = Math.round(scrollPercentage) + '%';
      });


function sendProgress(p) {
    const data = "progress=" + encodeURIComponent(p);
    fetch('save_progress.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: data
    })
    .then(r => r.text())
    .then(text => console.log(text))
    .catch(err => console.error(err));
}
</script>

</body>
</html>