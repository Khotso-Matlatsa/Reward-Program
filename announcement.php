<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: logins.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* Handle Comment */
if (isset($_POST['comment'])) {

    $announcement_id = $_POST['announcement_id'];
    $comment = mysqli_real_escape_string($conn, $_POST['commentcontent']);

    $insert_comment = "INSERT INTO tblannouncement_comments 
        (announcement_id, user_id, comment) 
        VALUES ('$announcement_id', '$user_id', '$comment')";

    mysqli_query($conn, $insert_comment);
}

/* Fetch Announcements */
$sql = "SELECT * FROM tblannouncements ORDER BY date_created DESC";
$result = mysqli_query($conn, $sql);
$announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Announcements</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-900 via-indigo-900 to-purple-900 min-h-screen text-white">

<div class="max-w-4xl mx-auto py-10 px-4">

    <h1 class="text-4xl font-bold text-center mb-10">📢 Announcements</h1>

    <?php foreach ($announcements as $announcement): ?>

    <div class="backdrop-blur-lg bg-white/10 border border-white/20 rounded-2xl p-6 mb-8 shadow-xl">

        <!-- Subject -->
        <h2 class="text-2xl font-semibold text-blue-300 mb-2">
            <?php echo $announcement['subject']; ?>
        </h2>

        <!-- Date -->
        <p class="text-sm text-gray-300 mb-4">
            Posted on 
            <?php echo date("F j, Y g:i A", strtotime($announcement['date_created'])); ?>
        </p>

        <!-- Content -->
        <p class="text-gray-200 mb-6">
            <?php echo nl2br($announcement['content']); ?>
        </p>

        <!-- COMMENTS SECTION -->
        <div class="bg-white/5 rounded-xl p-4 mb-4">
            <h3 class="text-lg font-semibold mb-3 text-indigo-300">💬 Comments</h3>

            <?php
            $id = $announcement['announcementid'];
            $comments_query = "SELECT * FROM tblannouncement_comments 
                               WHERE announcement_id = '$id' 
                               ORDER BY comment_date DESC";
            $comments_result = mysqli_query($conn, $comments_query);
            ?>

            <?php if (mysqli_num_rows($comments_result) > 0): ?>
                <?php while ($comment = mysqli_fetch_assoc($comments_result)): ?>
                    <div class="bg-white/10 p-3 rounded-lg mb-3">
                        <p class="text-gray-100"><?php echo $comment['comment']; ?></p>
                        <p class="text-xs text-gray-400 mt-1">
                            <?php echo date("F j, Y g:i A", strtotime($comment['comment_date'])); ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-gray-400 text-sm">No comments yet.</p>
            <?php endif; ?>
        </div>

        <!-- COMMENT FORM -->
        <form method="POST" class="space-y-3">
            <input type="hidden" name="announcement_id"
                value="<?php echo $announcement['announcementid']; ?>">

            <textarea name="commentcontent"
                class="w-full p-3 rounded-xl bg-white/10 border border-white/20 
                       focus:outline-none focus:ring-2 focus:ring-indigo-400 
                       text-white placeholder-gray-400"
                rows="2"
                placeholder="Write your comment..." required></textarea>

            <button type="submit" name="comment"
                class="bg-indigo-500 hover:bg-indigo-600 transition 
                       px-5 py-2 rounded-xl font-semibold shadow-lg">
                Post Comment
            </button>
        </form>

    </div>

    <?php endforeach; ?>

</div>

</body>
</html>