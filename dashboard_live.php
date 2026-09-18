<?php
require_once 'config.php';
requireLogin();

$userId = (int)$_SESSION['user_id'];
$role   = $_SESSION['role'];

/* COUNTS */
$users = null;
if ($role === 'admin') {
    $users = (int)$conn->query("SELECT COUNT(*) total FROM users")->fetch_assoc()['total'];
}

$media = (int)$conn->query("SELECT COUNT(*) total FROM media")->fetch_assoc()['total'];

$likes = ($role === 'admin')
    ? (int)$conn->query("SELECT COUNT(*) total FROM media_likes")->fetch_assoc()['total']
    : (int)$conn->query("SELECT COUNT(*) total FROM media_likes WHERE user_id = $userId")->fetch_assoc()['total'];

/* SCROLL */
$avgScroll = 0;
$res = $conn->query("
    SELECT ROUND(AVG(scroll_percent)) avg 
    FROM media_scroll 
    WHERE scroll_percent > 0
");
if ($res && $row = $res->fetch_assoc()) {
    $avgScroll = (int)$row['avg'];
}

/* LIKES CHART */
$likesLabels = [];
$likesData   = [];

$res = $conn->query("
    SELECT m.id, COUNT(ml.id) likes
    FROM media m
    LEFT JOIN media_likes ml ON ml.media_id = m.id
    GROUP BY m.id
");

while ($row = $res->fetch_assoc()) {
    $likesLabels[] = 'Media '.$row['id'];
    $likesData[]   = (int)$row['likes'];
}

/* SCROLL CHART */
$scrollLabels = [];
$scrollData   = [];

$res = $conn->query("
    SELECT DATE(created_at) day, ROUND(AVG(scroll_percent)) avg
    FROM media_scroll
    GROUP BY DATE(created_at)
    ORDER BY day ASC
");

while ($row = $res->fetch_assoc()) {
    $scrollLabels[] = $row['day'];
    $scrollData[]   = (int)$row['avg'];
}

echo json_encode([
    'users'       => $users,
    'media'       => $media,
    'likes'       => $likes,
    'avgScroll'   => $avgScroll,
    'likesLabels' => $likesLabels,
    'likesData'   => $likesData,
    'scrollLabels'=> $scrollLabels,
    'scrollData'  => $scrollData
]);
