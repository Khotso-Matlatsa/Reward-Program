<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request");
}

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    die("Please fill all fields");
}

$stmt = $conn->prepare("
    INSERT INTO contacts (fullnames, email, phone, message, status)
    VALUES (?, ?, ?, ?, 'Unresolved')
");

$stmt->bind_param("ssss", $name, $email, $phone, $message);
$stmt->execute();

/* Redirect back to landing page */
header("Location: index.php?success=1");
exit;
?>