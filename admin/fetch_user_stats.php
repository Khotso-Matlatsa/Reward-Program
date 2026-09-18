<?php
require_once '../config.php';

header('Content-Type: application/json');

$sql = "
SELECT 
    u.id,
    u.name,
    u.email,

    COUNT(DISTINCT l.id) AS total_likes,
    COUNT(DISTINCT v.id) AS total_views,
    IFNULL(ROUND(AVG(s.scroll_percent)),0) AS avg_scroll

FROM users u

LEFT JOIN media_likes l 
    ON l.user_id = u.id

LEFT JOIN media_views v 
    ON v.user_id = u.id

LEFT JOIN media_scroll s 
    ON s.user_id = u.id

GROUP BY u.id
ORDER BY u.id DESC
";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
