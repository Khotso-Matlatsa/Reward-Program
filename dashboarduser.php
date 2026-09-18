<?php
require_once __DIR__ . '/config.php';

requireLogin();

$userId = $_SESSION['user_id'];
/* HANDLE SURVEY COMPLETION */
if (isset($_GET['complete_survey'])) {

    $taskId = (int)$_GET['complete_survey'];

    // Get survey details
    $taskStmt = $conn->prepare("
        SELECT title, reward_points, surveylink
        FROM tasks
        WHERE task_id = ? AND task_type = 'survey'
    ");
    $taskStmt->bind_param("i", $taskId);
    $taskStmt->execute();
    $task = $taskStmt->get_result()->fetch_assoc();

    if ($task) {

        // Check if already completed
        $checkStmt = $conn->prepare("
            SELECT id FROM user_activity
            WHERE user_id = ? AND activity_type = 'survey' AND activity_name = ?
        ");
        $checkStmt->bind_param("is", $userId, $task['title']);
        $checkStmt->execute();
        $exists = $checkStmt->get_result()->num_rows;

        if ($exists == 0) {

            // Insert into user_activity
            $insertStmt = $conn->prepare("
                INSERT INTO user_activity 
                (user_id, activity_type, activity_name, reward_points, status)
                VALUES (?, 'survey', ?, ?, 'completed')
            ");
            $insertStmt->bind_param("isi", $userId, $task['title'], $task['reward_points']);
            $insertStmt->execute();
        }

        // Redirect to actual survey link
        header("Location: " . $task['surveylink']);
        exit();
    }
}

/* FETCH USER STATS */
$stmt = $conn->prepare("
    SELECT 
        clicks,
        invitations,
        completed_tasks,
        total_rewards,
        referrals,
        surveys_done
    FROM user_stats
    WHERE user_id = ?
    LIMIT 1
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stats = $stmt->get_result()->fetch_assoc();

/* FALLBACK IF USER HAS NO STATS YET */
$stats = $stats ?: [
    'clicks' => 0,
    'invitations' => 0,
    'completed_tasks' => 0,
    'total_rewards' => 0,
    'referrals' => 0,
    'surveys_done' => 0,
];
/* ===========================
   REAL-TIME DATA CALCULATION
   =========================== */

/* REAL COMPLETED TASKS */
$taskStmt = $conn->prepare("
    SELECT COUNT(*) as total
    FROM user_activity
    WHERE user_id = ? AND status = 'completed'
");
$taskStmt->bind_param("i", $userId);
$taskStmt->execute();
$taskResult = $taskStmt->get_result()->fetch_assoc();
$realCompletedTasks = (int)($taskResult['total'] ?? 0);

/* REAL TOTAL REWARDS */
$rewardStmt = $conn->prepare("
    SELECT SUM(reward_points) as total
    FROM user_activity
    WHERE user_id = ? AND status = 'completed'
");
$rewardStmt->bind_param("i", $userId);
$rewardStmt->execute();
$rewardResult = $rewardStmt->get_result()->fetch_assoc();
$realRewards = (int)($rewardResult['total'] ?? 0);

/* REAL REFERRALS */
$realReferrals = 0;

$tableCheck = $conn->query("SHOW TABLES LIKE 'referrals'");

if ($tableCheck && $tableCheck->num_rows > 0) {

    $refStmt = $conn->prepare("
        SELECT COUNT(*) as total
        FROM referrals
        WHERE referrer_id = ?
    ");

    if ($refStmt) {
        $refStmt->bind_param("i", $userId);
        $refStmt->execute();
        $refResult = $refStmt->get_result()->fetch_assoc();
        $realReferrals = (int)($refResult['total'] ?? 0);
    }
}

$refStmt->bind_param("i", $userId);
$refStmt->execute();
$refResult = $refStmt->get_result()->fetch_assoc();
$realReferrals = (int)($refResult['total'] ?? 0);

/* REAL SURVEYS DONE */
$surveyCount = 0;
if ($conn->query("SHOW TABLES LIKE 'survey_submissions'")->num_rows > 0) {
    $surveyStmt = $conn->prepare("
        SELECT COUNT(*) as total
        FROM survey_submissions
        WHERE user_id = ?
    ");
    $surveyStmt->bind_param("i", $userId);
    $surveyStmt->execute();
    $surveyResult = $surveyStmt->get_result()->fetch_assoc();
    $surveyCount = (int)($surveyResult['total'] ?? 0);
}

/* REAL LIKES (Optional – if table exists) */
$likesCount = 0;
if ($conn->query("SHOW TABLES LIKE 'media_likes'")->num_rows > 0) {
    $likesStmt = $conn->prepare("
        SELECT COUNT(*) as total
        FROM media_likes
        WHERE user_id = ?
    ");
    $likesStmt->bind_param("i", $userId);
    $likesStmt->execute();
    $likesResult = $likesStmt->get_result()->fetch_assoc();
    $likesCount = (int)($likesResult['total'] ?? 0);
}

/* OVERRIDE STATS WITH REAL DATA */
$stats['completed_tasks'] = $realCompletedTasks;
$stats['total_rewards'] = $realRewards;
$stats['referrals'] = $realReferrals;
$stats['surveys_done'] = $surveyCount;
$stats['clicks'] = $likesCount;

/* FETCH ADMIN MEDIA POSTS */
$mediaQuery = $conn->query("
    SELECT *
    FROM media_posts
    ORDER BY created_at DESC
");
/* FETCH SURVEY TASKS FROM ADMIN */
$surveyTasks = [];

$surveyStmt = $conn->prepare("
    SELECT task_id, title, description, surveylink, reward_points
    FROM tasks
    WHERE task_type = 'survey'
    ORDER BY task_id DESC
");

if ($surveyStmt) {
    $surveyStmt->execute();
    $result = $surveyStmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $surveyTasks[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<style>
:root{
  --bg-main:#eef3fb;
  --bg-card:#ffffff;
  --primary:#4169e1;
  --text-dark:#222;
  --text-muted:#666;
}

body{
  margin:0;
  font-family:Arial, Helvetica, sans-serif;
  background:var(--bg-main);
  color:var(--text-dark);
}

details{
  position:fixed;
  top:20px;
  left:20px;
  z-index:100;
}

summary{
  list-style:none;
  cursor:pointer;
  padding:10px;
  border-radius:6px;
  background:#fff;
  border:1px solid #ddd;
}

summary::-webkit-details-marker{display:none;}

.menu{
  margin-top:10px;
  background:#fff;
  border-radius:8px;
  box-shadow:0 10px 30px rgba(0,0,0,.1);
}

.menu a{
  display:block;
  padding:14px 20px;
  text-decoration:none;
  color:#333;
  border-bottom:1px solid #eee;
}

.menu a:hover{
  background:#f3f6ff;
}

.dashboard{
  max-width:1200px;
  margin:80px auto;
  padding:0 30px;
}

.dashboard-header{
  margin-bottom:40px;
}

.dashboard-header h1{
  margin:0;
  font-size:28px;
}

.dashboard-header p{
  color:var(--text-muted);
}

.stats-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
  gap:20px;
  margin-bottom:40px;
}

.stat-card{
  background:var(--bg-card);
  padding:25px;
  border-radius:12px;
  text-align:center;
  box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.stat-card span{
  display:block;
  font-size:32px;
  margin-top:10px;
  color:var(--primary);
}

.referral-box{
  background:var(--bg-card);
  padding:30px;
  border-radius:14px;
  box-shadow:0 8px 20px rgba(0,0,0,.08);
  max-width:500px;
}
2
.referral-row{
  display:flex;
  gap:10px;
}

.referral-row input{
  flex:1;
  padding:10px;
}

button{
  padding:10px 18px;
  border:none;
  border-radius:6px;
  cursor:pointer;
  background:var(--primary);
  color:#fff;
}
</style>
</head>

<body>

<details>
  <summary>☰</summary>
  <nav class="menu">
    <a href="dashboarduser.php">Overview</a>
    <a href="cardgrid.php">Software experience</a>
    <a href="rewardsclaim.php">Claim Rewards</a>
    <a href="views.php">My Views</a>
    <a href="dashboard/playerlist.php">Video Tasks</a>
    <a href="gallery.php">Image Gallery</a>
    <a href="announcement.php">Announcements</a>
     <a href="responsivetable.php">Careers</a>
    <a href="logout.php" style="color:#dc2626;font-weight:bold;">
      <i class="ion-log-out"></i> Logout
    </a>
    <a href="surveyform.php"
   class="bg-green-600 text-white px-4 py-2 rounded-lg">
   View Surveys
</a>
  </nav>
</details>

<div class="dashboard">

  <header class="dashboard-header">
    <h1>Welcome Back 👋</h1>
    <p>Your activity summary and rewards progress</p>
  </header>

  <section class="stats-grid">
    <div class="stat-card">Clicks <span><?= (int)$stats['clicks'] ?></span></div>
    <div class="stat-card">Invitations <span><?= (int)$stats['invitations'] ?></span></div>
    <div class="stat-card">Completed Tasks <span><?= (int)$stats['completed_tasks'] ?></span></div>
    <div class="stat-card">Total Rewards <span><?= (int)$stats['total_rewards'] ?></span></div>
    <div class="stat-card">Referrals <span><?= (int)$stats['referrals'] ?></span></div>
    <div class="stat-card">Surveys Done <span><?= (int)$stats['surveys_done'] ?></span></div>
  </section>

  <section class="referral-box">
<?php
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT referral_code FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$refCode = $user['referral_code'];
$refLink = "http://localhost/yourproject/register.php?ref=" . $refCode;
?>

<div style="background:#fff;padding:20px;border-radius:8px;margin-top:20px;">
    <h3>Your Referral Code</h3>

    <input type="text" value="<?php echo $refCode; ?>" id="refCode" readonly>
    <button onclick="copyCode()">Copy Code</button>

    <h3 style="margin-top:15px;">Your Referral Link</h3>

    <input type="text" value="<?php echo $refLink; ?>" id="refLink" readonly>
    <button onclick="copyLink()">Copy Link</button>
</div>

<script>
function copyCode() {
    let copyText = document.getElementById("refCode");
    copyText.select();
    document.execCommand("copy");
    alert("Referral Code Copied!");
}

function copyLink() {
    let copyText = document.getElementById("refLink");
    copyText.select();
    document.execCommand("copy");
    alert("Referral Link Copied!");
}
</script>
  </section>

  <?php while ($post = $mediaQuery->fetch_assoc()): ?>
    <div style="
      background:#fff;
      padding:20px;
      border-radius:12px;
      margin-bottom:25px;
      box-shadow:0 6px 18px rgba(0,0,0,.08);
    ">

      <h3><?= htmlspecialchars($post['title']) ?></h3>
      <p><?= nl2br(htmlspecialchars($post['description'])) ?></p>

      <?php if ($post['media_type'] === 'image'): ?>
        <img src="<?= $post['media_path'] ?>" style="width:100%;border-radius:10px;">
      <?php else: ?>
        <video controls style="width:100%;border-radius:10px;">
          <source src="<?= $post['media_path'] ?>">
        </video>
      <?php endif; ?>

    </div>
  <?php endwhile; ?>
</section>

</div>

</body>
</html>
