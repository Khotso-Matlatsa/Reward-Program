<?php 
require_once 'config.php';
requireAdmin();

$message = "";

/* DELETE JOB */
if(isset($_GET['delete'])){

    $job_id = intval($_GET['delete']);

    mysqli_query($conn,"DELETE FROM jobs WHERE id='$job_id'");

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

/* ADD JOB */
if(isset($_POST['add_job'])){

    $position = mysqli_real_escape_string($conn,$_POST['position']);
    $requirements = mysqli_real_escape_string($conn,$_POST['requirements']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $job_type = mysqli_real_escape_string($conn,$_POST['job_type']);
    $deadline = $_POST['deadline'];

    $sql = "INSERT INTO jobs (position,requirements,email,job_type,deadline)
            VALUES ('$position','$requirements','$email','$job_type','$deadline')";

    if(mysqli_query($conn,$sql)){
        $message = "Job posted successfully!";
    } else {
        $message = "Error posting job.";
    }
}

/* FETCH JOBS */
$jobs = mysqli_query($conn,"SELECT * FROM jobs ORDER BY deadline DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin - Post Job</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

<!-- Sidebar -->
<div class="w-64 bg-black text-white p-6 hidden md:block">
    <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
    <ul class="space-y-4">
        <li><a href="#" class="hover:text-gray-400">Dashboard</a></li>
        <li><a href="#" class="hover:text-gray-400">Post Job</a></li>
        <li><a href="#" class="hover:text-gray-400">Manage Jobs</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="flex-1 p-10">

<div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-4xl mx-auto">

<h2 class="text-3xl font-bold text-center mb-8">Post Job Vacancy</h2>

<?php if($message!=""){ ?>
<div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 text-center">
    <?php echo $message; ?>
</div>
<?php } ?>

<form method="POST" class="space-y-6 mb-10">

<div>
<label class="block font-semibold mb-2">Position</label>
<input type="text" name="position" required
class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-black focus:outline-none">
</div>

<div>
<label class="block font-semibold mb-2">Requirements</label>
<textarea name="requirements" rows="4" required
class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-black focus:outline-none"></textarea>
</div>

<div>
<label class="block font-semibold mb-2">Application Email</label>
<input type="email" name="email" required
class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-black focus:outline-none">
</div>

<div>
<label class="block font-semibold mb-2">Job Type</label>
<select name="job_type" required
class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-black focus:outline-none">
<option value="">Select Job Type</option>
<option>Full-time</option>
<option>Part-time</option>
<option>Internship</option>
<option>Contract</option>
</select>
</div>

<div>
<label class="block font-semibold mb-2">Application Deadline</label>
<input type="datetime-local" name="deadline" required
class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-black focus:outline-none">
</div>

<button type="submit" name="add_job"
class="w-full bg-black text-white py-3 rounded-xl font-semibold hover:bg-gray-800 transition">
Post Job
</button>

</form>


<!-- JOB LIST -->
<h3 class="text-2xl font-bold mb-6">Posted Jobs</h3>

<?php while($job = mysqli_fetch_assoc($jobs)){ ?>

<div class="border rounded-xl p-6 mb-6 bg-gray-50">

<h4 class="text-xl font-bold mb-2"><?php echo $job['position']; ?></h4>

<p class="text-gray-700 mb-2">
<b>Type:</b> <?php echo $job['job_type']; ?>
</p>

<p class="text-gray-700 mb-2">
<b>Email:</b> <?php echo $job['email']; ?>
</p>

<p class="text-gray-700 mb-2">
<b>Deadline:</b> <?php echo date("F j, Y g:i A", strtotime($job['deadline'])); ?>
</p>

<p class="text-gray-700 mb-4">
<?php echo nl2br($job['requirements']); ?>
</p>

<a href="?delete=<?php echo $job['id']; ?>"
onclick="return confirm('Are you sure you want to delete this job?')"
class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
Delete Job
</a>

</div>

<?php } ?>

</div>
</div>

</body>
</html>