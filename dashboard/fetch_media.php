<?php 
session_start();
require_once '../config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$current_user_id = (int)$_SESSION['user_id'];

$sql = "
SELECT 
    m.id,
    m.filename,
    m.filepath,
    m.type,
    m.business_name,
    m.price,
    m.created_at,

    IFNULL(v.user_views, 0) AS user_views,
    IFNULL(l.user_likes, 0) AS user_likes,
    IFNULL(ul.user_liked, 0) AS user_liked,
    IFNULL(s.user_scroll, 0) AS user_scroll

FROM media m

LEFT JOIN (
    SELECT media_id, COUNT(*) AS user_views
    FROM media_views
    WHERE user_id = ?
    GROUP BY media_id
) v ON v.media_id = m.id

LEFT JOIN (
    SELECT media_id, COUNT(*) AS user_likes
    FROM media_likes
    WHERE user_id = ?
    GROUP BY media_id
) l ON l.media_id = m.id

LEFT JOIN (
    SELECT media_id, 1 AS user_liked
    FROM media_likes
    WHERE user_id = ?
    GROUP BY media_id
) ul ON ul.media_id = m.id

LEFT JOIN (
    SELECT media_id, MAX(scroll_percent) AS user_scroll
    FROM media_scroll
    WHERE user_id = ?
    GROUP BY media_id
) s ON s.media_id = m.id

ORDER BY m.created_at DESC
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "error" => "Database prepare failed",
        "details" => $conn->error
    ]);
    exit;
}

$stmt->bind_param(
    "iiii",
    $current_user_id,
    $current_user_id,
    $current_user_id,
    $current_user_id
);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode([
        "error" => "Database execute failed",
        "details" => $stmt->error
    ]);
    exit;
}

$result = $stmt->get_result();
$media = [];

while ($row = $result->fetch_assoc()) {

    // 🔥 CLEAN FILE PATH (IMPORTANT FIX)
    $filepath = trim($row["filepath"]);

    // Remove leading slashes or "quicks/"
    $filepath = preg_replace('#^/?quicks/#', '', $filepath);
    $filepath = ltrim($filepath, '/');

    $media[] = [
        "id" => (int)$row["id"],
        "filename" => $row["filename"],
        "filepath" => $filepath,
        "type" => $row["type"],
        "price" => $row["price"] !== null ? (float)$row["price"] : null,
        "business_name" => $row["business_name"],
        "created_at" => $row["created_at"],
        "user_views" => (int)$row["user_views"],
        "user_likes" => (int)$row["user_likes"],
        "user_liked" => (bool)$row["user_liked"],
        "user_scroll" => (int)$row["user_scroll"]
    ];
}

echo json_encode($media);
exit;
?>