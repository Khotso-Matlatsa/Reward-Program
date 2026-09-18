<?php
session_start();
require_once '../config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in'
    ]);
    exit;
}

if (!isset($_POST['media_id']) || !isset($_POST['scroll_percent'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Missing media_id or scroll_percent'
    ]);
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$media_id = (int)$_POST['media_id'];
$percent = (int)$_POST['scroll_percent'];

/* Clamp scroll percent between 0 and 100 */
if ($percent < 0) $percent = 0;
if ($percent > 100) $percent = 100;

$previous_scroll = 0;
$record_exists = false;
$points_awarded = false;
$activity_logged = false;
$debug_message = '';

/* -----------------------------
   CHECK EXISTING SCROLL RECORD
------------------------------*/
$check = $conn->prepare("
    SELECT scroll_percent
    FROM media_scroll
    WHERE user_id = ? AND media_id = ?
    LIMIT 1
");

if (!$check) {
    echo json_encode([
        'success' => false,
        'message' => 'Prepare failed for select: ' . $conn->error
    ]);
    exit;
}

$check->bind_param("ii", $user_id, $media_id);
$check->execute();
$result = $check->get_result();

if ($row = $result->fetch_assoc()) {
    $previous_scroll = (int)$row['scroll_percent'];
    $record_exists = true;
}
$check->close();

/* -----------------------------
   UPDATE OR INSERT SCROLL
------------------------------*/
if ($record_exists) {
    $update = $conn->prepare("
        UPDATE media_scroll
        SET scroll_percent = GREATEST(scroll_percent, ?)
        WHERE user_id = ? AND media_id = ?
    ");

    if (!$update) {
        echo json_encode([
            'success' => false,
            'message' => 'Prepare failed for update: ' . $conn->error
        ]);
        exit;
    }

    $update->bind_param("iii", $percent, $user_id, $media_id);
    $update->execute();
    $update->close();
} else {
    $insert = $conn->prepare("
        INSERT INTO media_scroll (user_id, media_id, scroll_percent)
        VALUES (?, ?, ?)
    ");

    if (!$insert) {
        echo json_encode([
            'success' => false,
            'message' => 'Prepare failed for insert: ' . $conn->error
        ]);
        exit;
    }

    $insert->bind_param("iii", $user_id, $media_id, $percent);
    $insert->execute();
    $insert->close();
}

/* -----------------------------
   GIVE POINTS IF 80% REACHED
------------------------------*/
if ($previous_scroll < 80 && $percent >= 80) {

    $filename = 'Unknown Media';

    /* GET MEDIA NAME */
    $mediaQuery = $conn->prepare("
        SELECT filename FROM media WHERE id = ? LIMIT 1
    ");

    if ($mediaQuery) {
        $mediaQuery->bind_param("i", $media_id);
        $mediaQuery->execute();
        $mediaQuery->bind_result($fetchedFilename);
        if ($mediaQuery->fetch() && !empty($fetchedFilename)) {
            $filename = $fetchedFilename;
        }
        $mediaQuery->close();
    }

    /* RECORD ACTIVITY */
    $activity_name = "Scrolled media: " . $filename;

    $activity = $conn->prepare("
        INSERT INTO user_activity
        (user_id, activity_type, activity_name, status, reward_points, created_at)
        VALUES (?, 'Scroll', ?, 'completed', 2, NOW())
    ");

    if ($activity) {
        $activity->bind_param("is", $user_id, $activity_name);
        $activity_logged = $activity->execute();
        $activity->close();
    }

    /* ADD CONTRIBUTION POINTS */
    $points = 2;

    $pointsStmt = $conn->prepare("
        UPDATE users
        SET contribution_points = contribution_points + ?
        WHERE id = ?
    ");

    if ($pointsStmt) {
        $pointsStmt->bind_param("ii", $points, $user_id);
        $points_awarded = $pointsStmt->execute();
        $pointsStmt->close();
    }

    $debug_message = '80% reached, points awarded.';
} else {
    $debug_message = 'Scroll saved, but reward threshold not reached yet.';
}

/* -----------------------------
   GET UPDATED SCROLL + POINTS
------------------------------*/
$current_scroll = 0;
$current_points = 0;

$finalScroll = $conn->prepare("
    SELECT scroll_percent
    FROM media_scroll
    WHERE user_id = ? AND media_id = ?
    LIMIT 1
");
if ($finalScroll) {
    $finalScroll->bind_param("ii", $user_id, $media_id);
    $finalScroll->execute();
    $finalScroll->bind_result($current_scroll);
    $finalScroll->fetch();
    $finalScroll->close();
}

$userPoints = $conn->prepare("
    SELECT contribution_points
    FROM users
    WHERE id = ?
    LIMIT 1
");
if ($userPoints) {
    $userPoints->bind_param("i", $user_id);
    $userPoints->execute();
    $userPoints->bind_result($current_points);
    $userPoints->fetch();
    $userPoints->close();
}

echo json_encode([
    'success' => true,
    'message' => $debug_message,
    'previous_scroll' => $previous_scroll,
    'current_scroll' => (int)$current_scroll,
    'points_awarded' => $points_awarded,
    'activity_logged' => $activity_logged,
    'contribution_points' => (int)$current_points
]);
exit;
?>