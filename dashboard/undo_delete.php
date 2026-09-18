<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$id = (int)($_POST['id'] ?? 0);

$stmt = $conn->prepare(
    "UPDATE videos 
     SET is_deleted = 0, deleted_at = NULL
     WHERE id = ?"
);
$stmt->bind_param('i', $id);
$stmt->execute();

echo json_encode(['success' => true]);
