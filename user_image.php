<?php
require_once(__DIR__ . '/config.php');
requireLogin();

$query = "SELECT * FROM images ORDER BY upload_date DESC";
$result = mysqli_query($conn, $query);
?>

<h2>Image Gallery</h2>

<div style="display:flex; flex-wrap:wrap; gap:15px;">
<?php while($row = mysqli_fetch_assoc($result)): ?>
    <div style="width:200px;">
        <img src="../uploads/<?php echo htmlspecialchars($row['filename']); ?>" 
             style="width:100%; height:150px; object-fit:cover;">
        <p><?php echo htmlspecialchars($row['original_name']); ?></p>
    </div>
<?php endwhile; ?>
</div>
