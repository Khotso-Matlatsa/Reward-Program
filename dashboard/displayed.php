<?php
  
    // Connect to database 
    include('db.php');
  
    // Check if id is set or not if true toggle,
    // else simply go back to the page
    if (isset($_GET['product_ID'])){
  
        // Store the value from get to a 
        // local variable "course_id"
        $course_id=$_GET['product_ID'];
  
        // SQL query that sets the status
        // to 1 to indicate activation.
        $sql="UPDATE `businesses` SET 
             `status`=1 WHERE product_ID='$course_id'";
  
        // Execute the query
        mysqli_query($con,$sql);
    }
  
    // Go back to course-page.php
    header('location: testcontent1.php');
?>