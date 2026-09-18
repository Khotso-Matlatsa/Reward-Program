<?php
  
    // Connect to database 
    include('db.php');
  
    // Get all the courses from courses table
    // execute the query 
    // Store the result
    $sql = "SELECT * FROM `contacts`";
    $Sql_query = mysqli_query($con,$sql);
    $All_contacts = mysqli_fetch_all($Sql_query,MYSQLI_ASSOC);
?>
  
  
    <table border="1">
        <!-- TABLE TOP ROW HEADINGS-->
        <tr>
            
            <th>Caller ID</th>
            <th>Full names</th>
			 <th>Email</th>
            <th>Phone </th>
			<th>Message</th>
			<th>Delete</th>
            <th>Status</th>
			<th>Action</th>
			
        </tr>
        <?php
  
            // Use foreach to access all the courses data
            foreach ($All_contacts as $course) { ?>
            <tr>
                <td><?php echo $course['caller_ID']; ?></td>
				<td><?php echo $course['fullnames']; ?></td>
				<td><?php echo $course['email']; ?></td>
				<td><?php echo $course['phone']; ?></td>
				<td><?php echo $course['message']; ?></td>
				<td><a href="messagedelete.php?id=<?php echo $row['caller_ID']; ?>">Delete</a></td> 
                <td><?php 
                        // Usage of if-else statement to translate the 
                        // tinyint status value into some common terms
                        // 0-Inactive
                        // 1-Active
                        if($course['status']=="1") 
                            echo "Resolved";
                        else 
                            echo "Pending";
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
"<a href=pending.php?caller_ID=".$course['caller_ID']." class='btn red'>Pending</a>";
                    else 
                        echo 
"<a href=resolved.php?caller_ID=".$course['caller_ID']." class='btn green'>Resolved</a>";
                    ?>
            </tr>
           <?php
                }
                // End the foreach loop 
           ?>
    </table>

  
  