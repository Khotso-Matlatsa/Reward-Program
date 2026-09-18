<?php
session_start();
require_once '../config.php';

header('Content-Type: application/json');

/* -----------------------------
   VALIDATION
------------------------------*/
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "Not logged in"]);
    exit;
}

if (!isset($_POST['media_id'])) {
    echo json_encode(["success" => false, "error" => "No media id"]);
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$media_id = (int)$_POST['media_id'];

/* -----------------------------
   CHECK IF VIEW EXISTS
------------------------------*/
$check = $conn->prepare("
    SELECT id FROM media_views
    WHERE user_id = ? AND media_id = ?
");
$check->bind_param("ii", $user_id, $media_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["success" => true, "message" => "Already viewed"]);
    exit;
}

/* -----------------------------
   INSERT VIEW
------------------------------*/
$stmt = $conn->prepare("
    INSERT INTO media_views (user_id, media_id)
    VALUES (?, ?)
");

if (!$stmt) {
    echo json_encode(["success" => false, "error" => $conn->error]);
    exit;
}

$stmt->bind_param("ii", $user_id, $media_id);
$stmt->execute();

/* -----------------------------
   GET MEDIA NAME
------------------------------*/
$filename = "Unknown";

$mediaQuery = $conn->prepare("
    SELECT filename FROM media WHERE id = ?
");
$mediaQuery->bind_param("i", $media_id);
$mediaQuery->execute();
$mediaQuery->bind_result($filename);
$mediaQuery->fetch();
$mediaQuery->close();

/* -----------------------------
   RECORD ACTIVITY
------------------------------*/
$activity_name = "Viewed media: " . $filename;

$activityStmt = $conn->prepare("
    INSERT INTO user_activity
    (user_id, activity_type, activity_name, status, created_at)
    VALUES (?, 'View', ?, 'completed', NOW())
");
$activityStmt->bind_param("is", $user_id, $activity_name);
$activityStmt->execute();

/* -----------------------------
   ADD POINTS
------------------------------*/
$points = 3;

$pointsStmt = $conn->prepare("
    UPDATE users
    SET contribution_points = contribution_points + ?
    WHERE id = ?
");
$pointsStmt->bind_param("ii", $points, $user_id);
$pointsStmt->execute();

/* -----------------------------
   RESPONSE
------------------------------*/
echo json_encode(["success" => true, "message" => "View recorded"]);
?>