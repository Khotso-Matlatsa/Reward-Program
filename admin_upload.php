<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/config.php');
requireAdmin();

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {

    $file = $_FILES['image'];

    if ($file['error'] === 0) {

        $folder = "uploads/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $filename = time() . "_" . basename($file['name']);
        $targetPath = $folder . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {

            $stmt = $conn->prepare("INSERT INTO images 
                (filename, original_name, upload_date, file_size, mime_type) 
                VALUES (?, ?, NOW(), ?, ?)");

            if ($stmt) {
                $stmt->bind_param(
                    "ssis",
                    $filename,
                    $file['name'],
                    $file['size'],
                    $file['type']
                );
                $stmt->execute();
                $stmt->close();
                $success = "Image uploaded successfully!";
            } else {
                $error = "Database error: " . $conn->error;
            }
        } else {
            $error = "Failed to move uploaded file.";
        }
    } else {
        $error = "Upload error.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Upload Images</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center p-6">

<div class="w-full max-w-xl backdrop-blur-lg bg-white/20 border border-white/30 rounded-3xl shadow-2xl p-8 text-white">

    <h1 class="text-3xl font-bold text-center mb-6">
        Upload Images
    </h1>

    <?php if ($success): ?>
        <div class="bg-green-500/30 border border-green-300 px-4 py-3 rounded-lg mb-4">
            ✅ <?= $success ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="bg-red-500/30 border border-red-300 px-4 py-3 rounded-lg mb-4">
            ❌ <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <label class="flex flex-col items-center justify-center border-2 border-dashed border-white/40 rounded-2xl p-10 cursor-pointer hover:bg-white/10 transition">

            <span class="text-lg font-semibold">
                Choose Image File
            </span>

            <span class="text-sm opacity-70 mt-1">
                JPEG, PNG, GIF, WebP
            </span>

            <input type="file" name="image" class="hidden" required>
        </label>

        <div class="flex justify-center gap-4 mt-6">

            <button type="submit"
                class="px-6 py-2 rounded-full bg-white/30 border border-white/40 hover:bg-white/50 transition font-semibold">
                Upload
            </button>

            <a href="admin_gallery.php"
               class="px-6 py-2 rounded-full bg-black/30 border border-white/40 hover:bg-black/50 transition font-semibold">
               Gallery
            </a>

        </div>

    </form>

</div>

</body>
</html>
