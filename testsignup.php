<?php

	echo <<<_END
	             <form action="testsignup1.php" method="post">
				   <input type="text" name="Surveytitle" placeholder="Survey title" required>
				   <input type="text" name="Businessname" placeholder="Business name" required>
				   <input type="text" name="surveydescription" placeholder="Survey description" required>
				   <input type="text" name="surveylink" placeholder="Survey link" required>
				    <input type="datetime-local" name="completeby" placeholder="Deadline">
				   <button type="submit" name="btn_save" onclick="myfunction()">Send</button>
				   </form>
	
	
	_END;
?>












