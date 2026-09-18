<?php
require_once __DIR__ . '/../db.php';
header('Content-Type: application/json');

// safety check
if (!isset($_GET['path'])) {
    echo json_encode([]);
    exit;
}

$media_path = $_GET['path'];

$stmt = mysqli_prepare(
    $con,
    "SELECT comment, created_at 
     FROM media_comments 
     WHERE media_path = ? 
     ORDER BY created_at DESC"
);

mysqli_stmt_bind_param($stmt, "s", $media_path);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$comments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $comments[] = $row;
}

echo json_encode($comments);
