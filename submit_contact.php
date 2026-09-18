<?php  
session_start();
require_once 'config.php';

/* ===========================
   ADMIN ACCESS ONLY
=========================== */
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    die("Access denied");
}

/* ===========================
   CSRF TOKEN
=========================== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ===========================
   HANDLE ACTIONS (POST ONLY)
=========================== */
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    // UPDATE STATUS
    if (isset($_POST['update_status'])) {
        $id = intval($_POST['id']);
        $status = ($_POST['status'] === 'Resolved') ? 'Resolved' : 'Unresolved';

        $stmt = $conn->prepare("UPDATE contacts SET status=? WHERE caller_ID=?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();

        $message = "Status updated successfully!";
    }

    // DELETE MESSAGE
    if (isset($_POST['delete'])) {
        $id = intval($_POST['id']);

        $stmt = $conn->prepare("DELETE FROM contacts WHERE caller_ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $message = "Message deleted successfully!";
    }
}

/* ===========================
   FETCH DATA
=========================== */
$result = $conn->query("SELECT * FROM contacts ORDER BY caller_ID DESC");

/* ===========================
   STATS
=========================== */
$total = $conn->query("SELECT COUNT(*) as count FROM contacts")->fetch_assoc()['count'];
$resolved = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE status='Resolved'")->fetch_assoc()['count'];
$unresolved = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE status!='Resolved'")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard - Contact Messages</title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    background: linear-gradient(135deg, #1e3a8a, #9333ea);
}
.glass {
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,0.2);
}
</style>
</head>

<body class="min-h-screen text-white p-6">

<div class="max-w-7xl mx-auto">

<!-- HEADER -->
<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-bold">📩 Contact Management</h2>
    <a href="dashboard2.php" class="bg-white/20 px-4 py-2 rounded-xl hover:bg-white/30">
        ← Back to Dashboard
    </a>
</div>

<!-- SUCCESS MESSAGE -->
<?php if($message): ?>
<div class="mb-4 bg-green-500/20 border border-green-400 p-3 rounded-xl">
    <?= $message ?>
</div>
<?php endif; ?>

<!-- STATS -->
<div class="grid grid-cols-3 gap-4 mb-6 text-center">
    <div class="glass p-4 rounded-xl">
        <p class="text-xl font-bold"><?= $total ?></p>
        <p>Total</p>
    </div>
    <div class="glass p-4 rounded-xl">
        <p class="text-green-400 text-xl font-bold"><?= $resolved ?></p>
        <p>Resolved</p>
    </div>
    <div class="glass p-4 rounded-xl">
        <p class="text-red-400 text-xl font-bold"><?= $unresolved ?></p>
        <p>Unresolved</p>
    </div>
</div>

<!-- TABLE -->
<div class="glass rounded-3xl p-6 shadow-xl overflow-x-auto">

<table class="w-full text-sm text-left">
<thead>
<tr class="border-b border-white/20">
    <th class="p-3">ID</th>
    <th class="p-3">Name</th>
    <th class="p-3">Email</th>
    <th class="p-3">Phone</th>
    <th class="p-3">Message</th>
    <th class="p-3">Status</th>
    <th class="p-3">Actions</th>
</tr>
</thead>

<tbody>
<?php while($row = $result->fetch_assoc()): ?>
<tr class="border-b border-white/10 hover:bg-white/10 transition">

<td class="p-3"><?= $row['caller_ID'] ?></td>

<td class="p-3"><?= htmlspecialchars($row['fullnames']) ?></td>
<td class="p-3"><?= htmlspecialchars($row['email']) ?></td>
<td class="p-3"><?= htmlspecialchars($row['phone']) ?></td>
<td class="p-3"><?= htmlspecialchars($row['message']) ?></td>

<!-- STATUS -->
<td class="p-3">
<?php if($row['status'] == 'Resolved'): ?>
    <span class="text-green-400 font-semibold">✔ Resolved</span>
<?php else: ?>
    <span class="text-red-400 font-semibold">✖ Unresolved</span>
<?php endif; ?>
</td>

<!-- ACTIONS -->
<td class="p-3 space-y-2">

<!-- TOGGLE STATUS -->
<form method="POST">
    <input type="hidden" name="id" value="<?= $row['caller_ID'] ?>">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    
    <?php if($row['status'] == 'Resolved'): ?>
        <input type="hidden" name="status" value="Unresolved">
        <button name="update_status"
            class="w-full bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-1 rounded-lg">
            Mark Unresolved
        </button>
    <?php else: ?>
        <input type="hidden" name="status" value="Resolved">
        <button name="update_status"
            class="w-full bg-green-500 hover:bg-green-600 text-black px-3 py-1 rounded-lg">
            Mark Resolved
        </button>
    <?php endif; ?>
</form>

<!-- DELETE -->
<form method="POST" onsubmit="return confirm('Delete this message?')">
    <input type="hidden" name="id" value="<?= $row['caller_ID'] ?>">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    
    <button name="delete"
        class="w-full bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg">
        Delete
    </button>
</form>

</td>

</tr>
<?php endwhile; ?>
</tbody>

</table>

</div>

</div>

</body>
</html>