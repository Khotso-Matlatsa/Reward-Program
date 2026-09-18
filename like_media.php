<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

/* READ JSON INPUT */
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['user_id']) || !isset($data['media_id'])) {
    echo json_encode(['success' => false]);
    exit;
}

$user_id  = (int)$_SESSION['user_id'];
$media_id = (int)$data['media_id'];

/* CHECK IF ALREADY LIKED */
$check = $conn->prepare("
    SELECT id FROM media_likes 
    WHERE user_id = ? AND media_id = ?
");
$check->bind_param("ii", $user_id, $media_id);
$check->execute();
$check->store_result();

if ($check->num_rows === 0) {

    /* INSERT LIKE */
    $likeStmt = $conn->prepare("
        INSERT INTO media_likes (user_id, media_id)
        VALUES (?, ?)
    ");
    $likeStmt->bind_param("ii", $user_id, $media_id);
    $likeStmt->execute();

    /* GET MEDIA NAME */
    $mediaQuery = $conn->prepare("
        SELECT filename FROM media WHERE id = ?
    ");
    $mediaQuery->bind_param("i", $media_id);
    $mediaQuery->execute();
    $mediaQuery->bind_result($filename);
    $mediaQuery->fetch();
    $mediaQuery->close();

    /* RECORD USER ACTIVITY */
    $activity_name = "Liked: " . $filename;

    $activityStmt = $conn->prepare("
        INSERT INTO user_activity
        (user_id, activity_type, activity_name, status, created_at)
        VALUES (?, 'Like', ?, 'completed', NOW())
    ");

    $activityStmt->bind_param("is", $user_id, $activity_name);
    $activityStmt->execute();

    /* ADD CONTRIBUTION POINTS */
    $points = 5;

    $pointsStmt = $conn->prepare("
        UPDATE users
        SET contribution_points = contribution_points + ?
        WHERE id = ?
    ");
    $pointsStmt->bind_param("ii", $points, $user_id);
    $pointsStmt->execute();
}

/* GET USER-SPECIFIC LIKE COUNT */
$res = $conn->prepare("
    SELECT COUNT(*) 
    FROM media_likes 
    WHERE media_id = ? AND user_id = ?
");

$res->bind_param("ii", $media_id, $user_id);
$res->execute();
$res->bind_result($likes);
$res->fetch();

echo json_encode([
    'success' => true,
    'likes'   => (int)$likes
]);

exit;
?>