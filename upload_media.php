<?php
session_start();
require_once 'config.php';

/* ===============================
   SECURITY CHECK: ADMIN ONLY
================================= */
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    die("Access denied.");
}

/* ===============================
   ONLY ALLOW POST
================================= */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die("Invalid request.");
}

/* ===============================
   FILE VALIDATION
================================= */
if (!isset($_FILES['media']) || $_FILES['media']['error'] !== 0) {
    die("Upload failed.");
}

$file = $_FILES['media'];
$price = isset($_POST['price']) && $_POST['price'] !== '' ? (float)$_POST['price'] : null;
$business = trim($_POST['business_name'] ?? '');

/* ===============================
   SIZE LIMIT
================================= */
$maxSize = 50 * 1024 * 1024; // 50MB
if ($file['size'] > $maxSize) {
    die("File too large. Max 50MB.");
}

/* ===============================
   MIME VALIDATION
================================= */
$allowedTypes = [
    'image/jpeg',
    'image/png',
    'image/gif',
    'video/mp4',
    'video/webm'
];

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mime, $allowedTypes)) {
    die("Invalid file type.");
}

/* ===============================
   SAFE FILE NAME
================================= */
$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$newName = "media_" . time() . "_" . mt_rand(1000,9999) . "." . $extension;

/* ===============================
   UPLOAD PATH (IMPORTANT FIX)
================================= */
$uploadDir = __DIR__ . "/uploads/";
$uploadPath = $uploadDir . $newName;

/* Ensure folder exists */
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

/* ===============================
   MOVE FILE
================================= */
if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
    die("Failed to save file.");
}

/* ===============================
   DETERMINE TYPE
================================= */
$type = (strpos($mime, 'video') !== false) ? 'video' : 'image';

/* Only images can have price */
if ($type !== 'image') {
    $price = null;
}

/* ===============================
   STORE CLEAN RELATIVE PATH
================================= */
$relativePath = "uploads/" . $newName; // ✅ DO NOT CHANGE THIS

/* ===============================
   SAVE TO DATABASE
================================= */
$stmt = $conn->prepare("
    INSERT INTO media 
    (filename, filepath, type, price, business_name, created_at)
    VALUES (?, ?, ?, ?, ?, NOW())
");

if (!$stmt) {
    die("DB Error: " . $conn->error);
}

$stmt->bind_param(
    "ssdss",
    $newName,
    $relativePath,
    $type,
    $price,
    $business
);

$stmt->execute();
$stmt->close();

/* ===============================
   REDIRECT
================================= */
header("Location: dashboard/playerlist.php");
exit;
?>