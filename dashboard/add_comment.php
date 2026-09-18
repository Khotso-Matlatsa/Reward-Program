<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$media_id = intval($data['media_id'] ?? 0);
$comment = trim($data['comment'] ?? '');
$user_id = $_SESSION['user_id'];

if (!$media_id || empty($comment)) {
    echo json_encode(["success" => false]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO comments (media_id, user_id, comment) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $media_id, $user_id, $comment);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}