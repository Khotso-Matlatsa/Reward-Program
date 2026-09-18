<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once '../config.php';

/* ---------- METHOD CHECK ---------- */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

/* ---------- FILE CHECK ---------- */
if (!isset($_FILES['media'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No file uploaded']);
    exit;
}

$file = $_FILES['media'];

if ($file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Upload error',
        'code'  => $file['error']
    ]);
    exit;
}

/* ---------- PRICE ---------- */
$price = (isset($_POST['price']) && $_POST['price'] !== '')
    ? floatval($_POST['price'])
    : null;

/* ---------- FILE TYPE ---------- */
$allowedImages = ['jpg','jpeg','png','webp'];
$allowedVideos = ['mp4','webm','ogg'];

$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if (in_array($ext, $allowedImages)) {
    $type = 'image';
} elseif (in_array($ext, $allowedVideos)) {
    $type  = 'video';
    $price = null; // videos are always free
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Unsupported file type']);
    exit;
}

/* ---------- PATHS ---------- */
// physical folder (server)
$uploadDirFs = __DIR__ . '/../uploads/';

// path stored in DB (used by browser)
$uploadDirDb = 'uploads/';

if (!is_dir($uploadDirFs)) {
    mkdir($uploadDirFs, 0777, true);
}

$filename = uniqid('media_', true) . '.' . $ext;
$dbPath   = $uploadDirDb . $filename;
$fsPath   = $uploadDirFs . $filename;

/* ---------- MOVE FILE ---------- */
if (!move_uploaded_file($file['tmp_name'], $fsPath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save uploaded file']);
    exit;
}

/* ---------- DB INSERT ---------- */
$stmt = $conn->prepare("
    INSERT INTO media (filename, filepath, type, price)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param(
    "sssd",
    $filename,
    $dbPath,
    $type,
    $price
);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode([
        'error'   => 'Database insert failed',
        'details'=> $stmt->error
    ]);
    exit;
}

/* ---------- SUCCESS ---------- */
echo json_encode([
    'success'  => true,
    'message'  => 'Media uploaded successfully',
    'file'     => $dbPath,
    'type'     => $type
]);
exit;
