<?php

session_start ();
if (isset ($_SESSION['email'])){
	
	session_destroy();
	header ("location: login1.php");
}
echo <<<_END

<DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <title>table</title>
	<link href="" rel="stylesheet"/>
</head>
<body>
   <form action="logout.php" method="post">
    
		      
			   <input type="button" value="logout" name="logout"/>
			   
		   
	</form>
		   
		   
</body>
</html>	


_END;

?>