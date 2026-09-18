
	<?php
  
    // Connect to database 
    include('db.php');
  
    // Get all the courses from courses table
    // execute the query 
    // Store the result
    $sql = "SELECT * FROM `files`";
    $Sql_query = mysqli_query($con,$sql);
    $All_content = mysqli_fetch_all($Sql_query,MYSQLI_ASSOC);
?>
  
  
    <table border="1">
        <!-- TABLE TOP ROW HEADINGS-->
        <tr>
            
            <th>File ID</th>
            <th>File names</th>
			<th>Delete</th>
            <th>Status</th>
			<th>Action</th>
			
        </tr>
        <?php
  
            // Use foreach to access all the courses data
            foreach ($All_content as $course) { ?>
            <tr>
                <td><?php echo $course['file_id']; ?></td>
				<td><?php echo $course['filename']; ?></td>
				
				<td><a href="deletefile.php?id=<?php echo $row['file_id']; ?>">Delete</a></td> 
                <td><?php 
                        // Usage of if-else statement to translate the 
                        // tinyint status value into some common terms
                        // 0-Inactive
                        // 1-Active
                        if($course['status']=="1") 
                            echo "Played";
                        else 
                            echo "not played";
                    ?>                          
                </td>
                <td>
                    <?php 
                    if($course['status']=="1") 
  
                        // if a course is active i.e. status is 1 
                        // the toggle button must be able to deactivate 
                        // we echo the hyperlink to the page "deactivate.php"
                        // in order to make it look like a button
                        // we use the appropriate css
                        // red-deactivate
                        // green- activate
                        echo 
"<a href=notplayed.php?file_id=".$course['file_id']." class='btn red'>Not played</a>";
                    else 
                        echo 
"<a href=played.php?file_id=".$course['file_id']." class='btn green'>Played</a>";
                    ?>
            </tr>
           <?php
                }
                // End the foreach loop 
           ?>
    </table>

