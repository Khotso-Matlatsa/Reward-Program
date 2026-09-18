<?php
require_once 'config.php';

$sql = "SELECT * FROM jobs ORDER BY id DESC";
$result = mysqli_query($conn,$sql);
$jobs = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Careers</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-6 py-16">

<div class="text-center mb-14">
<h1 class="text-4xl md:text-5xl font-bold">Careers Page</h1>
<p class="text-gray-500 mt-3">Join our team and grow with us</p>
</div>

<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

<?php foreach($jobs as $job){ ?>

<div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl hover:-translate-y-2 transition duration-300 flex flex-col">

<h3 class="text-2xl font-bold mb-4">
<?php echo htmlspecialchars($job['position']); ?>
</h3>

<p class="text-gray-600 mb-4 flex-grow">
<?php echo htmlspecialchars($job['requirements']); ?>
</p>

<div class="space-y-2 text-sm text-gray-500 mb-6">
<p><span class="font-semibold text-gray-700">Type:</span> <?php echo htmlspecialchars($job['job_type']); ?></p>
<p><span class="font-semibold text-gray-700">Deadline:</span> <?php echo date("Y-m-d H:i", strtotime($job['deadline'])); ?></p>
<p><span class="font-semibold text-gray-700">Apply To:</span> <?php echo htmlspecialchars($job['email']); ?></p>
</div>

<a href="mailto:<?php echo htmlspecialchars($job['email']); ?>"
class="mt-auto bg-black text-white text-center py-3 rounded-xl font-semibold hover:bg-gray-800 transition">
Apply Now
</a>

</div>

<?php } ?>

</div>

</div>

</body>
</html>