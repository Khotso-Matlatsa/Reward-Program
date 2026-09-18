<?php
require_once __DIR__ . '/../db.php';
session_start();

$path = $_POST['path'];
$comment = $_POST['comment'];
$user = $_SESSION['user_id'];

$conn->query("INSERT INTO comments (user_id, media_path, comment) 
VALUES ('$user','$path','$comment')");
