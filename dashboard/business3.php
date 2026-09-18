

<?php
echo <<<_END

<!DOCTYPE html>
<html>
<body>

<form action="loads1.php" method="post" enctype="multipart/form-data">

<input type="text" name="businessname" placeholder="business name" />
<input type="text" name="product" placeholder="product" />
<input type="text" name="business_price" placeholder="business price" />

  Select image to upload:
  
<input name="files[]" type="file" multiple="multiple" />

             <select name="businesstype" >
			  <option name="businesstype value="">Business Type</option>
			  <option name="businesstype value="restaurant">Restaurant</option>
			  <option name="businesstype value="pharmacy">Pharmacy</option>
			<option name="businesstype value="other">Other</option>
           </select>

  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>


_END;

?>