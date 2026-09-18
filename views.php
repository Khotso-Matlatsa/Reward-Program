<?php
session_start();
require_once("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: logins.php");
    exit();
}

$user_id = intval($_SESSION['user_id']);

/* -------------------------------------------------
   RECORD VIEW ACTIVITY ONLY ONCE PER SESSION
--------------------------------------------------*/
if (!isset($_SESSION['view_recorded'])) {

    $activity_type = "View";
    $activity_name = "Visited activity history page";
    $status = "completed";

    $stmt = $conn->prepare("
        INSERT INTO user_activity
        (user_id, activity_type, activity_name, status, created_at)
        VALUES (?, ?, ?, ?, NOW())
    ");

    $stmt->bind_param("isss", $user_id, $activity_type, $activity_name, $status);
    $stmt->execute();

    /* ADD CONTRIBUTION POINT */
    $points = 1;

    $updatePoints = $conn->prepare("
        UPDATE users
        SET contribution_points = contribution_points + ?
        WHERE id = ?
    ");

    $updatePoints->bind_param("ii", $points, $user_id);
    $updatePoints->execute();

    /* PREVENT REFRESH FARMING */
    $_SESSION['view_recorded'] = true;
}

/* -------------------------------------------------
   FETCH USER ACTIVITY HISTORY
--------------------------------------------------*/
$query = "
SELECT 
    u.name,
    ua.activity_type,
    ua.activity_name,
    ua.status,
    ua.created_at
FROM user_activity ua
JOIN users u ON u.id = ua.user_id
WHERE ua.user_id = ?
ORDER BY ua.created_at DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<html>
<head>
    <title>User Track Record</title>
    <link rel="stylesheet" href="homes.css">
</head>

<body>

<h2>User Activity / Progress</h2>

<table border="2" cellpadding="10">

<tr>
    <th>Name</th>
    <th>Activity Type</th>
    <th>Activity Name</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['activity_type']}</td>
            <td>{$row['activity_name']}</td>
            <td>{$row['status']}</td>
            <td>{$row['created_at']}</td>
        </tr>";
    }

} else {

    echo "<tr><td colspan='5'>No activity recorded yet.</td></tr>";
}
?>

</table>

</body>
</html>