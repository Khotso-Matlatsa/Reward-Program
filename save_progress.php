
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


include('db.php');
/*

	if (isset($_POST['progress'])) {
        $p = floatval($_POST['progress']);
		$createdAt = date('Y-m-d H:i:s');
		
	

	
		

		$query = "INSERT INTO `tblproductview` 
		(`productviewid`, `useremail`, `scrollpercentage`, `dateandtime`)    
		VALUES (NULL, '$useremail', '$p', '$createdAt')";
		
   		echo $table = mysqli_query($con,$query);
    
		if($table){
		
			header("location:viewproducts.php");
		}
		mysqli_close($con); // Closing Connection
	}
	*/
	
	

// If POST contains 'progress', insert it

if (isset($_POST['progress'])) {
    $p = floatval($_POST['progress']);
    $stmt = $conn->prepare("INSERT INTO tblproductview (useremail, scrollpercentage, dateandtime) VALUES (?. ?, ?)");
    $stmt->bind_param("d", $p);
    $stmt->execute();
    $stmt->close();

    echo "Progress saved: " . $p;
    exit;
}

// Optional: show a message if accessed normally
echo "This PHP file saves scroll percentage via POST.";


	

?>


























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




// Show errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ecommerce";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// If POST contains 'progress', insert it
if (isset($_POST['progress'])) {
	$useremail=$_POST['email'];
    $p = floatval($_POST['progress']);
    $stmt = $conn->prepare("INSERT INTO tblproductview (useremail, scrollpercentage, dateandtime) VALUES (?,?,?)");
    $stmt->bind_param("d", $p);
    $stmt->execute();
    $stmt->close();

    echo "Progress saved: " . $p;
    exit;
}

// Optional: show a message if accessed normally
echo "This PHP file saves scroll percentage via POST.";
?>
