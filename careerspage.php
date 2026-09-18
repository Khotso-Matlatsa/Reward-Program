<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>careers</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	           <?php
	                     echo <<<_END
		  <body>
							<div class="footer-section2">
									<form action="careers.php" method="post">
										  <input type="text" name="position" placeholder="Position" required>
										  <input type="text" name="requirements" placeholder="requirement 1,2...." required>
										  <input type="number" name="positionsnumber" placeholder="Number of positions" required>
										  <input type="email" name="emailto" placeholder="Email applications to..." required>
										  <label for=""><select name="jobtype" class="jobtype">
										  <option>Job Type</option>
										  <option>Full-time</option>
										  <option>Part-time</option>
										  <option>internship</option>
										  </td>
										  </select></label>
										  <input type="datetime-local" name="applydate" placeholder="Send applications to..." required>
												   
										  <button type="submit" name="btn_save">Post</button>
									 </form>
							 </div>		   
		 </body>		
					
</html>
			             _END;

              ?>

			
			
		
			

			
			
			
			
			
			
			
			
			