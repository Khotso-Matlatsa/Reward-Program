<?php

include 'db.php';

if (isset($_POST['send']))
{

     $business_name=$_POST['businessname'];
$business_names= filter_var($business_name, FILTER_SANITIZE_STRING);
$business_product=$_POST['product'];
$business_products = filter_var($business_product, FILTER_SANITIZE_STRING);
$product_price=$_POST['business_price'];
$product_prices = filter_var($product_price, FILTER_SANITIZE_STRING);
$businesstype=$_POST['businesstype'];
$businessestype = filter_var($businesstype, FILTER_SANITIZE_STRING);
$name = "/^[a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";



//echo "information is ".$meal_code." - ".$restaurant_name." - ".$meal_name." - ".$meal_price;
$image =$_FILES['image']['name'];
$temp_name = $_FILES['image']['tmp_name'];

$dir="products\\";


if ($image!=""){
	if (file_exists($dir.$image)){
		//$image=time().'-'.$image;
		echo "file already exists";
	}

	
}
  if (move_uploaded_file(($_FILES["image"]["tmp_name"],
  "$dir=/.$image")){


//inserting values
$query = "INSERT INTO businesses VALUES('$business_name', '$business_product', '$product_price', '$image', '$businesstype')";
$result = $con->query($query);
if (!$result)

   echo "there was a problem with inserting values";
}
else
{
	echo "query was successful";
}

echo <<<_END
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
<form action="businesss.php" method="POST" enctype="multipart/form-data>
 <div class="signup-form">
             
	          <input type="text" name="businessname" placeholder="business name" class="txtb"/>
		      <input type="text" name="product" placeholder="product" class="txtb"/>
		      <input type="number" name="business_price" placeholder="business price" class="txtb"/>
			  <input type="file" name="image" class="txtb"/>
		       <label for=""><select name="businesstype" >
			  <option name="businesstype value="">Business Type</option>
			  <option name="businesstype value="restaurant">Restaurant</option>
			  <option name="businesstype value="pharmacy">Pharmacy</option>
			<option name="businesstype value="other">Other</option>
	
	</select></label>
			  
			  <input type="submit" name="send" value="upload" class="signup-btn">
	</div>    
    </form>
  

</body>
</html>
_END;

?>