<?php 

include('db.php');

$businessname=$_POST['businessname'];
$product=$_POST['product'];
$business_price=$_POST['business_price'];
$businesstype=$_POST['businesstype'];
$businessstatus=$_POST['imagestatus'];

 
 
 
 
 
 
 $files =$_FILES['files']['name'];
	// Configure upload directory and allowed file types
	$upload_dir = 'products'.DIRECTORY_SEPARATOR;
	$allowed_types = array('jpg', 'png', 'jpeg', 'gif', 'doc','pdf','docx');
	
	// Define maxsize for files i.e 2MB
	$maxsize = 2 * 1024 * 1024;

	// Checks if user sent an empty form
	if(!empty(array_filter($_FILES['files']['name']))) {

		// Loop through each file in files[] array
		foreach ($_FILES['files']['tmp_name'] as $key => $value) {
			
			$file_tmpname = $_FILES['files']['tmp_name'][$key];
			$file_name = $_FILES['files']['name'][$key];
			$file_size = $_FILES['files']['size'][$key];
			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

			// Set upload file path
			$filepath = $upload_dir.$file_name;

			// Check file type is allowed or not
			if(in_array(strtolower($file_ext), $allowed_types)) {

				// Verify file size - 2MB max
				if ($file_size > $maxsize)		
					echo "Error: File size is larger than the allowed limit.";

				// If file with name already exist then append time in
				// front of name of the file to avoid overwriting of file
				if(file_exists($filepath)) {
					$filepath = $upload_dir.time().$file_name;
					
					if( move_uploaded_file($file_tmpname, $filepath)) {
						echo "{$file_name} successfully uploaded <br />";
					}
					else {					
						echo "Error uploading {$file_name} <br />";
					}
				}
				else {
				
					if( move_uploaded_file($file_tmpname, $filepath))

						{
					//$sql="INSERT INTO fileuploads(name,size,downloads) VALUES('$filename',$size,0)";
			        //$sql = "INSERT INTO fileuploads VALUES('$file_name','$file_size','$file_ext')";
					
					$sql= "INSERT INTO businesses VALUES('','$businessname','$product','$business_price','$file_name','$businesstype','$businessstatus')";
					
			        if (mysqli_query($con,$sql))
						
						{
							
						echo "{$file_name} successfully uploaded <br />";
							   header('location:business.php');
						}
					}
					else {					
						echo "Error uploading {$file_name} <br />";
					}
				}
			}
			else {
				
				// If file extension not valid
				echo "Error uploading {$file_name} ";
				echo "({$file_ext} file type is not allowed)<br / >";
			}
		}
	}
	else {
		
		// If no files selected
		echo "No files selected.";
	}

/*if (isset($_POST['amount']) &&
	  isset($_POST['months']) &&
	  isset($_POST['dates']) &&
	  isset($_POST['call']) &&
	  isset($_POST['name']) &&
	  isset($_POST['files']))
	  
	  
{   
     $names=$_POST['names'];
     $phonenumber=$_POST['phonenumber'];
     $email=$_POST['email'];
     $message=$_POST['message'];
	   
	   
	   
	   $query = "INSERT INTO contacts VALUES('','$names','$phonenumber','$email','$message')";
	   $result = $conn->query($query);
	   if(!$result)echo "insert failed: $query<br> ".
	   $conn->error."<br><br>";
	
}*/


 
 /*
 
 if(mysqli_query($con,"INSERT INTO member(fname, lname, address,username, password)VALUES('$fname', '$lname','$address', '$username', '$password')")){ 
 
 echo "insertion successful";
 
 }else{
  $e=mysqli_error($conn);
 echo "insertion unsuccessful";  
 }
*/
?>