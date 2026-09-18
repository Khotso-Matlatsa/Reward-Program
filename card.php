<?php
session_start();
include("db.php");

if (!isset($_SESSION['useremail'])) {
    header("Location: login.php");
    exit();
}

/* ===========================
   FETCH SUMMARY TOTALS
=========================== */

$totalUsers = $con->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$totalViews = $con->query("SELECT COUNT(*) as total FROM media_views")->fetch_assoc()['total'];
$totalLikes = $con->query("SELECT COUNT(*) as total FROM media_likes")->fetch_assoc()['total'];
$totalSurveys = $con->query("SELECT COUNT(*) as total FROM surveys")->fetch_assoc()['total'];

/* ===========================
   FETCH USER ANALYTICS
=========================== */

$sql = "
SELECT 
    u.id,
    u.name,
    u.email,

    COUNT(DISTINCT v.id) AS total_views,
    COUNT(DISTINCT l.id) AS total_likes,
    IFNULL(ROUND(AVG(s.scroll_percent)),0) AS avg_scroll,
    COUNT(DISTINCT sv.id) AS total_surveys

FROM users u

LEFT JOIN media_views v ON v.user_id = u.id
LEFT JOIN media_likes l ON l.user_id = u.id
LEFT JOIN media_scroll s ON s.user_id = u.id
LEFT JOIN surveys sv ON sv.user_id = u.id

GROUP BY u.id
ORDER BY total_views DESC
";

$result = $con->query($sql);

$userData = [];
while ($row = $result->fetch_assoc()) {
    $userData[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Analytics Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        h1 {
            margin-bottom: 30px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h2 {
            margin: 0;
            font-size: 28px;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #222;
            color: white;
        }

        canvas {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<h1>Admin Analytics Dashboard</h1>

<!-- SUMMARY CARDS -->
<div class="cards">
    <div class="card">
        <h3>Total Users</h3>
        <h2><?php echo $totalUsers; ?></h2>
    </div>

    <div class="card">
        <h3>Total Views</h3>
        <h2><?php echo $totalViews; ?></h2>
    </div>

    <div class="card">
        <h3>Total Likes</h3>
        <h2><?php echo $totalLikes; ?></h2>
    </div>

    <div class="card">
        <h3>Total Surveys</h3>
        <h2><?php echo $totalSurveys; ?></h2>
    </div>
</div>

<!-- CHART -->
<h2>Likes Per User</h2>
<canvas id="likesChart"></canvas>

<!-- USER TABLE -->
<h2>User Activity</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Views</th>
            <th>Likes</th>
            <th>Avg Scroll %</th>
            <th>Surveys</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($userData as $user): ?>
        <tr>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['total_views']; ?></td>
            <td><?php echo $user['total_likes']; ?></td>
            <td><?php echo $user['avg_scroll']; ?>%</td>
            <td><?php echo $user['total_surveys']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
const userData = <?php echo json_encode($userData); ?>;

const labels = userData.map(u => u.name);
const likesData = userData.map(u => u.total_likes);

new Chart(document.getElementById('likesChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Likes',
            data: likesData
        }]
    }
});
</script>

</body>
</html>
