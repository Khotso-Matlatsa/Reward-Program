<?php
header('Content-Type: application/json');

$media_directory = "uploads/media/";
$allowed_extensions = ['mp4','webm','ogg','jpg','jpeg','png','gif'];

$media = [];

if (!is_dir($media_directory)) {
    echo json_encode([]);
    exit;
}

$files = scandir($media_directory);

foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if (in_array($ext, $allowed_extensions)) {
        $media[] = [
            'path' => $media_directory . $file,
            'type' => in_array($ext, ['jpg','jpeg','png','gif']) ? 'image' : 'video'
        ];
    }
}

echo json_encode($media);
