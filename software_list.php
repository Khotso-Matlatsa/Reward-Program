<?php
require_once 'config.php';

$result = $conn->query("SELECT * FROM softwaretasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Software</title>
    <style>
        body { font-family: Arial; padding:20px; }
        .card {
            border:1px solid #ddd;
            padding:15px;
            margin-bottom:15px;
            border-radius:10px;
        }
        a.btn {
            padding:8px 12px;
            background:black;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }
    </style>
</head>
<body>

<h2>Available Software</h2>

<?php while($row = $result->fetch_assoc()): ?>

<div class="card">
    <h3><?php echo $row['softwaretitle']; ?></h3>
    <p><?php echo $row['softwaredescription']; ?></p>

    <?php if (!empty($row['softwarefile'])): ?>
        <a class="btn" href="uploads/<?php echo $row['softwarefile']; ?>" download>
            Download
        </a>
    <?php endif; ?>

    <?php if (!empty($row['software_link'])): ?>
        <a class="btn" href="<?php echo $row['software_link']; ?>" target="_blank">
            Visit Link
        </a>
    <?php endif; ?>

</div>

<?php endwhile; ?>

</body>
</html>