<?php 
require_once 'config.php';
requireAdmin();

/* ================= DELETE ANNOUNCEMENT ================= */
if (isset($_GET['delete'])) {

    $announcement_id = intval($_GET['delete']);

    // Delete comments first (important if foreign key exists)
    mysqli_query($conn, 
        "DELETE FROM tblannouncement_comments 
         WHERE announcement_id = $announcement_id");

    // Delete announcement
    mysqli_query($conn, 
        "DELETE FROM tblannouncements 
         WHERE announcementid = $announcement_id");

    header("Location: admin_announcements.php"); // change if filename is different
    exit;
}


/* ================= POST ANNOUNCEMENT ================= */
if (isset($_POST['post_announcement'])) {

    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $insert = "INSERT INTO tblannouncements (subject, content) 
               VALUES ('$subject', '$content')";
    mysqli_query($conn, $insert);
}


/* ================= FETCH ANNOUNCEMENTS ================= */
$sql = "SELECT * FROM tblannouncements ORDER BY date_created DESC";
$result = mysqli_query($conn, $sql);
$announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Announcement Panel</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-900 to-purple-900 min-h-screen text-white p-8">

<div class="max-w-5xl mx-auto">

    <h1 class="text-4xl font-bold mb-10 text-center">
        📢 Admin Announcement Dashboard
    </h1>

    <!-- POST FORM -->
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 
                p-6 rounded-2xl shadow-xl mb-12">

        <h2 class="text-2xl font-semibold mb-6">Post New Announcement</h2>

        <form method="POST" class="space-y-4">

            <input type="text" name="subject"
                class="w-full p-3 rounded-xl bg-white/10 border border-white/20
                       focus:ring-2 focus:ring-indigo-400 outline-none"
                placeholder="Announcement Subject" required>

            <textarea name="content" rows="4"
                class="w-full p-3 rounded-xl bg-white/10 border border-white/20
                       focus:ring-2 focus:ring-indigo-400 outline-none"
                placeholder="Announcement Content" required></textarea>

            <button type="submit" name="post_announcement"
                class="bg-indigo-500 hover:bg-indigo-600 px-6 py-3 
                       rounded-xl font-semibold transition shadow-lg">
                Post Announcement
            </button>

        </form>
    </div>

    <!-- ANNOUNCEMENT LIST -->
    <?php foreach ($announcements as $announcement): ?>

    <div class="bg-white/10 backdrop-blur-lg border border-white/20 
                rounded-2xl p-6 mb-10 shadow-xl">

        <h2 class="text-2xl font-semibold text-blue-300 mb-2">
            <?php echo $announcement['subject']; ?>
        </h2>

        <p class="text-sm text-gray-300 mb-4">
            Posted on 
            <?php echo date("F j, Y g:i A", strtotime($announcement['date_created'])); ?>
        </p>

        <p class="text-gray-200 mb-6">
            <?php echo nl2br($announcement['content']); ?>
        </p>

        <!-- DELETE BUTTON -->
        <a href="?delete=<?php echo $announcement['announcementid']; ?>"
           onclick="return confirm('Are you sure you want to delete this announcement?')"
           class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-white font-semibold inline-block mb-6">
           Delete Announcement
        </a>

        <hr class="border-white/20 mb-4">

        <!-- COMMENTS SECTION -->
        <h3 class="text-lg font-semibold text-indigo-300 mb-4">
            💬 Comments
        </h3>

        <?php
        $id = $announcement['announcementid'];

        $comments_query = "SELECT * FROM tblannouncement_comments 
                           WHERE announcement_id = '$id'
                           ORDER BY comment_date DESC";

        $comments_result = mysqli_query($conn, $comments_query);
        ?>

        <?php if (mysqli_num_rows($comments_result) > 0): ?>
            <?php while ($comment = mysqli_fetch_assoc($comments_result)): ?>
                <div class="bg-white/5 p-4 rounded-xl mb-3">
                    <p class="text-gray-100">
                        <?php echo $comment['comment']; ?>
                    </p>
                    <p class="text-xs text-gray-400 mt-2">
                        <?php echo date("F j, Y g:i A", strtotime($comment['comment_date'])); ?>
                    </p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-gray-400 italic">No comments yet.</p>
        <?php endif; ?>

    </div>

    <?php endforeach; ?>

</div>

</body>
</html>