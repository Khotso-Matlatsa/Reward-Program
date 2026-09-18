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



  <?php
     include('db.php'); 
	 if (isset ($_SESSION['useremail'])){
	$sql= "SELECT * FROM urltable WHERE email = '$useremail' ";	 
	$result = $con->query($sql);
    if (!$result)
    {
    	echo "there was a problem with a query";
    }	 
		
     else{
       $rows = $result->num_rows;
	   $row = $result->fetch_array(MYSQLI_ASSOC);
	   $referrallink = $row['referrallink'];
      if ($rows == 0)
    {
	     echo "no records available";
    }
	else
	{
		?>
	   
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html>
  <head>
   
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="card.css">
	<title>responsive column cards</title>
  </head>
  <body>
  
  
  
  
  
  <?php echo "<h3> Welcome $useremail </h3>" ?>
  
  <input type="text" id="myInput" value="  <?php echo " $referrallink " ?>  " >
  
  <button id="copyButton" class="copybutton">Click to copy referral link</button><br><br><br>
  <button id="shareButton">Click to Share</button>
  
  
   <script>
   
               document.getElementById('copyButton').addEventListener('click', async () => {
		     
			   const textToCopy = document.getElementById('contentToCopy').innerText;
			   
			   try {
				   await navigator.clipboard.writeText(textToCopy);
				   alert('Text copied to clipboard');
			   } catch (err) {
				   console.error('failed to copy text: ', err);
				   alert ('failed to copy text.');
			   }
			   
			   });
			   
		 </script>
		 
		 
		 
		 <button onclick="myFunction()">copy text</button>
		 <script>
		     function myFunction() {
				 // get the text fielt
				 var copyText = document.getElementById("myInput");
				 // Select the text fielt
				 copyText.select();
				 copyText.setSelectionRange(0,99999); // For mobile devices
				 // Select the text fielt inside text fielt
				 navigator.clipboard.writeText(copyText.value);
				 alert("copied the text" + copyText.value);
			 }
		 
		 </script>        
		 
		 
		 
  
    </body>
</html>  

<?php
	}
}
		 
		 
	 }



