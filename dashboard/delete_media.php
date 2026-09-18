<?php
require_once '../config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request');
}

if (empty($_POST['id'])) {
    http_response_code(400);
    exit('Missing media id');
}

$mediaId = intval($_POST['id']);

/* === GET FILE PATH === */
$stmt = $conn->prepare("SELECT filepath FROM media WHERE id = ?");
$stmt->bind_param("i", $mediaId);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    http_response_code(404);
    exit('Media not found');
}

$row = $res->fetch_assoc();

/* === FILESYSTEM PATH === */
$fileOnDisk = dirname(__DIR__) . '/' . $row['filepath'];
// resolves to quicks/dashboard/uploads/file.ext

if (file_exists($fileOnDisk)) {
    unlink($fileOnDisk);
}

/* === DELETE DB ROW === */
$stmt = $conn->prepare("DELETE FROM media WHERE id = ?");
$stmt->bind_param("i", $mediaId);
$stmt->execute();

echo 'OK';
