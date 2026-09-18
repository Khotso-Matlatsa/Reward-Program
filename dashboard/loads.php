
<?php


include("db.php");


if(isset($_POST['submit']))
{
$businessname=$_POST['businessname'];
$product=$_POST['product'];
$business_price=$_POST['business_price'];
$businesstype=$_POST['businesstype'];



$files = array_filter($_FILES['upload']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count = count($_FILES['upload']['name']);
// Loop through every file
for( $i=0 ; $i < $total_count ; $i++ ) {
   //The temp file path is obtained
   $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
   //A file path needs to be present
   if ($tmpFilePath != ""){
      //Setup our new file path
      $newFilePath = "./products/" . $_FILES['upload']['name'][$i];
      //File is uploaded to temp dir
      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
		  
		  $sql= "INSERT INTO businesses (businessname, productname, sellingprice, filename, businesstype) VALUES ('$businessname','$product','$business_price','$files','$businesstype')";
					if (mysqli_query($con,$sql))
						
						{
						//	print_r($files)
						echo "successfully uploaded <br />";
						 header("location: business.php");
						}
             else {					
						echo "Error uploading  <br />";
					}
						
					
					

	  }
	  else {					
						echo "Error occured while uploading <br />";
					}

         //Other code goes here
      }
   }
}

