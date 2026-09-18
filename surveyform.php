<?php 
session_start();
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role']; // admin or user


/* ================= ADMIN DELETE SURVEY ================= */
if ($role === 'admin' && isset($_GET['delete'])) {

    $survey_id = intval($_GET['delete']);

    // Delete completions first (important if foreign key exists)
    mysqli_query($conn, "DELETE FROM survey_completions WHERE survey_id = $survey_id");

    // Delete survey
    mysqli_query($conn, "DELETE FROM surveys WHERE id = $survey_id");

    header("Location: surveys.php");
    exit;
}


/* ================= ADMIN ADD SURVEY ================= */
if ($role === 'admin' && isset($_POST['add_survey'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $link  = mysqli_real_escape_string($conn, $_POST['link']);

    mysqli_query($conn, "INSERT INTO surveys (title, link) VALUES ('$title','$link')");
}

/* ================= USER COMPLETE ================= */
if ($role === 'user' && isset($_GET['complete'])) {

    $survey_id = intval($_GET['complete']);

    $check = mysqli_query($conn,
        "SELECT * FROM survey_completions 
         WHERE survey_id=$survey_id AND user_id=$user_id");

    if (mysqli_num_rows($check) == 0) {

        // Save completion
        mysqli_query($conn,
            "INSERT INTO survey_completions (survey_id, user_id)
             VALUES ($survey_id, $user_id)");

        // Award contribution points
        if (function_exists('activity_points')) {
            activity_points($conn, $user_id, "survey");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Surveys</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-6xl mx-auto">

<h1 class="text-3xl font-bold mb-6 text-gray-800">📊 Surveys</h1>

<!-- ================= ADMIN ADD FORM ================= -->
<?php if ($role === 'admin'): ?>
<div class="bg-white p-6 rounded-2xl shadow mb-8">
    <h2 class="text-xl font-semibold mb-4">Post New Survey</h2>

    <form method="POST" class="grid md:grid-cols-3 gap-4">
        <input type="text" name="title" placeholder="Survey Title"
            class="border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" required>

        <input type="text" name="link" placeholder="Survey Link"
            class="border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" required>

        <button type="submit" name="add_survey"
            class="bg-blue-600 text-white rounded-lg px-6 py-3 hover:bg-blue-700 transition">
            Post Survey
        </button>
    </form>
</div>
<?php endif; ?>

<!-- ================= SURVEY LIST ================= -->
<div class="grid md:grid-cols-2 gap-6">

<?php
$surveys = mysqli_query($conn, "SELECT * FROM surveys ORDER BY id DESC");

while ($survey = mysqli_fetch_assoc($surveys)):

    $survey_id = $survey['id'];

    $total_users_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
    $total_users = mysqli_fetch_assoc($total_users_query)['total'];

    $completed_query = mysqli_query($conn,
        "SELECT COUNT(*) as total 
         FROM survey_completions 
         WHERE survey_id = $survey_id");

    $completed_users = mysqli_fetch_assoc($completed_query)['total'];

    $percentage = ($total_users > 0)
        ? round(($completed_users / $total_users) * 100)
        : 0;

    $user_check = mysqli_query($conn,
        "SELECT * FROM survey_completions 
         WHERE survey_id=$survey_id AND user_id=$user_id");
?>

<div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">

    <h2 class="text-xl font-semibold text-gray-800 mb-3">
        <?php echo $survey['title']; ?>
    </h2>

    <div class="mb-4 flex flex-wrap gap-3 items-center">
        <a href="<?php echo $survey['link']; ?>" target="_blank"
           class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
           Open Survey
        </a>

        <?php if ($role === 'user'): ?>
            <?php if (mysqli_num_rows($user_check) > 0): ?>
                <span class="bg-green-500 text-white px-4 py-2 rounded-lg">
                    Completed ✓
                </span>
            <?php else: ?>
                <a href="?complete=<?php echo $survey_id; ?>"
                   class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                   Mark Completed
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($role === 'admin'): ?>
            <!-- DELETE BUTTON -->
            <a href="?delete=<?php echo $survey_id; ?>"
               onclick="return confirm('Are you sure you want to delete this survey?')"
               class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
               Delete Survey
            </a>
        <?php endif; ?>
    </div>

    <div class="mb-2 text-sm text-gray-600">
        <?php echo $percentage; ?>% Completed
    </div>

    <div class="w-full bg-gray-200 rounded-full h-4">
        <div class="bg-green-500 h-4 rounded-full transition-all duration-500"
             style="width: <?php echo $percentage; ?>%;">
        </div>
    </div>

    <?php if ($role === 'admin'): ?>
        <div class="mt-4 border-t pt-3">
            <h4 class="font-semibold mb-2">Completed By:</h4>

            <?php
            $users = mysqli_query($conn,
                "SELECT users.name 
                 FROM survey_completions
                 JOIN users ON users.id = survey_completions.user_id
                 WHERE survey_completions.survey_id = $survey_id");

            if (mysqli_num_rows($users) > 0):
                while ($u = mysqli_fetch_assoc($users)):
                    echo "<p class='text-sm text-gray-700'>• ".$u['name']."</p>";
                endwhile;
            else:
                echo "<p class='text-sm text-gray-500'>No completions yet</p>";
            endif;
            ?>
        </div>
    <?php endif; ?>

</div>

<?php endwhile; ?>

</div>
</div>

</body>
</html>