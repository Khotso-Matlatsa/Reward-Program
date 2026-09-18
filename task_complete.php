<?php
session_start();
include("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$activity_type = 'task_completed';
$activity_name = $_GET['task'];

$query = "INSERT INTO user_activity (user_id, activity_type, activity_name, status)
          VALUES ('$user_id', '$activity_type', '$activity_name', 'completed')";

mysqli_query($conn, $query);

header("Location: views.php");
exit;
