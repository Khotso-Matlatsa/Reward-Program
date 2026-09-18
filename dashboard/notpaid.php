<?php
  
    // Connect to database 
include('db.php');
  
    // Check if id is set or not, if true,
    // toggle else simply go back to the page
    if (isset($_GET['claim_id'])){
  
        // Store the value from get to 
        // a local variable "course_id"
        $course_id=$_GET['claim_id'];
  
        // SQL query that sets the status to
        // 0 to indicate deactivation.
        $sql="UPDATE `claims` SET 
            `status`=0 WHERE claim_id='$course_id'";
  
        // Execute the query
        mysqli_query($con,$sql);
    }
  
    // Go back to course-page.php
    header('location: paymentclaim.php');
?>