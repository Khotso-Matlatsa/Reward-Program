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



<html>
	<head>
	<title>Displayed services/products for sale </title>
	<link rel="stylesheet" href="">
	<title>view table</title>
	
	
	<script>
		       document.addEventListener('DOMContentLoaded', () => {
			   const likeButton = document.querySelector('.like-button');
			   const likeCountSpan = document.querySelector('.like-count');
			   let likeCount = 0;
			   
			   likeButton.addEventListener('click',() => {
			   likeCount++;
			   
			   likeCountSpan.textContent = likeCount;
			   
			   });
			   
			   
			   
			   
			   });
			   
		 </script>
		 
	
	
	</head>
  

	
	<style>
	
	body{
	font-family:times new roman;
	
	
	height: 2000px;
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
/****like feature css****/
	   .like-container{
	       display: flex;
		   align-items: center;
	   }
	    .like-button{
		   background-color: #007bff;
		   color: white;
		   border: none;
		   padding: 8px 12px;
		   border-radius: 5px;
		   cursor: pointer;
		   display: flex;
		   align-items: center;
		}
		like-button:hover {
		     background-color: #0056b3
		}
		.like-count{
		   margin-left: 5px;
		   font-weight: bold;
		}
	
	/****like feature css****/
	
	
	</style>
	
	
	<body>
	

	

	
    <div  align="center" style="padding-top:50px">
	<h2 id="scrollPercentage">0%</h2>
	
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


//scroll percentage code

<script>
const scrollDisplay = document.getElementById('scrollPercentage');
let timeout = null;

window.addEventListener('scroll', function() {
    const scrollTop = document.documentElement.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrollPercentage = (scrollTop / scrollHeight) * 100;
    const rounded = Math.round(scrollPercentage);
    scrollDisplay.innerText = rounded + '%';

    // Send scroll percentage to server (throttled)
    if (timeout) clearTimeout(timeout);
    timeout = setTimeout(() => {
        sendProgress(rounded);
    }, 500);
	
	
	
	

    // Reveal images when they enter viewport
    const containers = document.querySelectorAll('.image-container');
    containers.forEach(container => {
        const rect = container.getBoundingClientRect();
        if(rect.top < window.innerHeight - 100) { // 100px before visible
            container.classList.add('visible');
        }
    });
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