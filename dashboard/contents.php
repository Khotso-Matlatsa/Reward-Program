
<?php
include 'db.php';


if (isset($_POST['save']))
{
	$filename=$_FILES['myfile']['name'];
	
	$destination='uploads/'.$filename;
	
	$extension=pathinfo($filename,PATHINFO_EXTENSION);
	
	$file= $_FILES['myfile']['tmp_name'];
	
	$size= $_FILES['myfile']['size'];
	
	if (!in_array($extension,['zip','jpg','pptx','pdf','docx','png','mp4']))
	{
		echo "your file  extension must be .zip,.jpg,.pptx,.docx,.pdf,.mp4,.png";
	}
	elseif($_FILES['myfile']['size'] > 300000000)
	{
		echo "file is too large";
	}
	else{
		if (move_uploaded_file($file,$destination))
		{
			$sql="INSERT INTO files(filename,size,downloads) VALUES('$filename',$size,0)";
			
			if (mysqli_query($con,$sql))
			{
				echo "file was successfully uploaded";
				//header("Location: downloads.php");
				
			}
			else{
				echo "failed to upload";
			}
		}
	}
}

   echo <<<_END

	
	  <form action="contents.php" method="POST" enctype="multipart/form-data">
	  
	  <input type="file" name="myfile" />
	<input type="submit" value="save" name="save"/>
	
	
	</form>
	

	
	
	_END;




?>