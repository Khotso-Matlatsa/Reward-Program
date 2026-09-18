<?php
session_start();
require_once '../config.php';

$media_id = intval($_GET['media_id'] ?? 0);

if (!$media_id) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("
    SELECT comments.comment, comments.created_at, users.username
    FROM comments
    JOIN users ON comments.user_id = users.id
    WHERE comments.media_id = ?
    ORDER BY comments.created_at DESC
");

$stmt->bind_param("i", $media_id);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];

while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

echo json_encode($comments);