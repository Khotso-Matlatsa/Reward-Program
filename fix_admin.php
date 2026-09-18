<?php
require_once 'config.php';

$newPassword = "admin123";
$hash = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "UPDATE users SET password=? WHERE email='admin@quicks.com'"
);
$stmt->bind_param("s", $hash);
$stmt->execute();

echo "Admin password reset OK";
