<?php 
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: logins.php");
    exit();
}

/* ===========================
   FETCH SUMMARY TOTALS
=========================== */

$totalUsers   = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$totalViews   = $conn->query("SELECT COUNT(*) as total FROM media_views")->fetch_assoc()['total'];
$totalLikes   = $conn->query("SELECT COUNT(*) as total FROM media_likes")->fetch_assoc()['total'];
$totalSurveys = $conn->query("SELECT COUNT(*) as total FROM survey_completions")->fetch_assoc()['total'];
$totalSurveyPosts = $conn->query("SELECT COUNT(*) as total FROM surveys")->fetch_assoc()['total'];

/* ===========================
   FETCH USER ANALYTICS (UPGRADED)
=========================== */

$sql = "
SELECT 
    u.id,
    u.name,
    u.email,
    u.contribution_points,

    /* Total Views (images + videos combined table) */
    (SELECT COUNT(*) FROM media_views v WHERE v.user_id = u.id) AS total_views,

    /* Likes */
    (SELECT COUNT(*) FROM media_likes l WHERE l.user_id = u.id) AS total_likes,

    /* Avg Scroll */
    (SELECT IFNULL(ROUND(AVG(scroll_percent)),0)
        FROM media_scroll s 
        WHERE s.user_id = u.id) AS avg_scroll,

    /* Surveys */
    (SELECT COUNT(*) 
        FROM survey_completions sc 
        WHERE sc.user_id = u.id) AS total_surveys,

    /* VIDEO WATCH COUNT (based on activity log) */
    (SELECT COUNT(*) 
        FROM user_activity ua 
        WHERE ua.user_id = u.id 
        AND ua.activity_type = 'Watch') AS total_watches,

    /* REFERRALS COUNT */
    (SELECT COUNT(*) 
        FROM users r 
        WHERE r.referred_by = u.id) AS total_referrals

FROM users u
ORDER BY total_views DESC
";

$result = $conn->query($sql);

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

        .cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
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

    <div class="card">
        <h3>Total Survey Posts</h3>
        <h2><?php echo $totalSurveyPosts; ?></h2>
    </div>
</div>

<!-- CHART -->
<h2>Likes Per User</h2>
<canvas id="likesChart"></canvas>

<h2>Referrals Per User</h2>
<canvas id="refChart"></canvas>

<!-- USER TABLE -->
<h2>User Activity</h2>
<table>
<thead>
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Views</th>
    <th>Watches</th>
    <th>Likes</th>
    <th>Avg Scroll</th>
    <th>Surveys</th>
    <th>Referrals</th>
    <th>Points</th>
</tr>
</thead>

<tbody>
<?php foreach($userData as $user): ?>
<tr>
    <td><?php echo htmlspecialchars($user['name']); ?></td>
    <td><?php echo htmlspecialchars($user['email']); ?></td>
    <td><?php echo $user['total_views']; ?></td>
    <td><?php echo $user['total_watches']; ?></td>
    <td><?php echo $user['total_likes']; ?></td>
    <td><?php echo $user['avg_scroll']; ?>%</td>
    <td><?php echo $user['total_surveys']; ?></td>
    <td><?php echo $user['total_referrals']; ?></td>
    <td><?php echo $user['contribution_points']; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<script>
const userData = <?php echo json_encode($userData); ?>;

/* Likes Chart */
new Chart(document.getElementById('likesChart'), {
    type: 'bar',
    data: {
        labels: userData.map(u => u.name),
        datasets: [{
            label: 'Likes',
            data: userData.map(u => u.total_likes)
        }]
    }
});

/* Referrals Chart */
new Chart(document.getElementById('refChart'), {
    type: 'bar',
    data: {
        labels: userData.map(u => u.name),
        datasets: [{
            label: 'Referrals',
            data: userData.map(u => u.total_referrals)
        }]
    }
});
</script>

</body>
</html>