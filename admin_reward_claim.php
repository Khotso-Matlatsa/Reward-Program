<?php
require_once 'config.php';
requireAdmin();

/* =====================================================
   SETTINGS
===================================================== */
$pointsThreshold = 500;
$minimumCashout  = 5.00;
$pointRate       = 0.01; // 500 points = $5.00

$message = "";

/* =====================================================
   HELPERS
===================================================== */
function esc($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function tableExists($conn, $tableName) {
    $tableName = mysqli_real_escape_string($conn, $tableName);
    $sql = "SHOW TABLES LIKE '$tableName'";
    $result = mysqli_query($conn, $sql);
    return $result && mysqli_num_rows($result) > 0;
}

function columnExists($conn, $tableName, $columnName) {
    $tableName = mysqli_real_escape_string($conn, $tableName);
    $columnName = mysqli_real_escape_string($conn, $columnName);
    $sql = "SHOW COLUMNS FROM `$tableName` LIKE '$columnName'";
    $result = mysqli_query($conn, $sql);
    return $result && mysqli_num_rows($result) > 0;
}

function getSingleValue($conn, $sql, $default = 0) {
    $result = mysqli_query($conn, $sql);
    if ($result && $row = mysqli_fetch_row($result)) {
        return $row[0];
    }
    return $default;
}

function getUserContributionPoints($conn, $userId) {
    $userId = (int)$userId;

    if (tableExists($conn, 'users') && columnExists($conn, 'users', 'contribution_points')) {
        $sql = "SELECT contribution_points FROM users WHERE id = $userId LIMIT 1";
        return (int)getSingleValue($conn, $sql, 0);
    }

    if (tableExists($conn, 'user_activity') && columnExists($conn, 'user_activity', 'reward_points')) {
        $sql = "SELECT COALESCE(SUM(reward_points),0) FROM user_activity WHERE user_id = $userId";
        return (int)getSingleValue($conn, $sql, 0);
    }

    if (tableExists($conn, 'user_activity') && columnExists($conn, 'user_activity', 'points_earned')) {
        $sql = "SELECT COALESCE(SUM(points_earned),0) FROM user_activity WHERE user_id = $userId";
        return (int)getSingleValue($conn, $sql, 0);
    }

    if (tableExists($conn, 'user_activity') && columnExists($conn, 'user_activity', 'points')) {
        $sql = "SELECT COALESCE(SUM(points),0) FROM user_activity WHERE user_id = $userId";
        return (int)getSingleValue($conn, $sql, 0);
    }

    return 0;
}

function getUserTotalEarnings($points, $pointRate) {
    return (float)$points * (float)$pointRate;
}

function isEligibleForReward($points, $earnings, $pointsThreshold, $minimumCashout) {
    return ($points >= $pointsThreshold || $earnings >= $minimumCashout);
}

/* =====================================================
   APPROVE / REJECT
===================================================== */
if (isset($_GET['approve'])) {
    $id = (int)$_GET['approve'];
    mysqli_query($conn, "UPDATE reward_claims SET status='Approved' WHERE id='$id'");
    header("Location: admin_reward_claim.php?msg=approved");
    exit;
}

if (isset($_GET['reject'])) {
    $id = (int)$_GET['reject'];
    mysqli_query($conn, "UPDATE reward_claims SET status='Rejected' WHERE id='$id'");
    header("Location: admin_reward_claim.php?msg=rejected");
    exit;
}

if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'approved') {
        $message = "Claim approved successfully.";
    } elseif ($_GET['msg'] === 'rejected') {
        $message = "Claim rejected successfully.";
    }
}

/* =====================================================
   EXPORT APPROVED CLAIMS - EXCEL
===================================================== */
if (isset($_GET['export']) && $_GET['export'] === 'excel') {
    $sql = "SELECT * FROM reward_claims WHERE status='Approved' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=approved_reward_claims_" . date('Ymd_His') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "Name\tEmail\tPhone\tReward Type\tPayment Method\tPoints\tEstimated Earnings\tEligibility\tStatus\tDate\n";

    while ($claim = mysqli_fetch_assoc($result)) {
        $userId   = (int)($claim['user_id'] ?? 0);
        $points   = getUserContributionPoints($conn, $userId);
        $earnings = getUserTotalEarnings($points, $pointRate);
        $eligible = isEligibleForReward($points, $earnings, $pointsThreshold, $minimumCashout) ? 'Eligible' : 'Not Eligible';

        echo
            str_replace(["\t", "\n", "\r"], ' ', $claim['full_name']) . "\t" .
            str_replace(["\t", "\n", "\r"], ' ', $claim['email']) . "\t" .
            str_replace(["\t", "\n", "\r"], ' ', $claim['phone']) . "\t" .
            str_replace(["\t", "\n", "\r"], ' ', $claim['reward_type']) . "\t" .
            str_replace(["\t", "\n", "\r"], ' ', $claim['payment_method']) . "\t" .
            $points . "\t" .
            number_format($earnings, 2) . "\t" .
            $eligible . "\t" .
            $claim['status'] . "\t" .
            $claim['created_at'] . "\n";
    }
    exit;
}

/* =====================================================
   EXPORT APPROVED CLAIMS - PDF
   Simple printable HTML as PDF-friendly output
===================================================== */
if (isset($_GET['export']) && $_GET['export'] === 'pdf') {
    $sql = "SELECT * FROM reward_claims WHERE status='Approved' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=approved_reward_claims_" . date('Ymd_His') . ".html");

    echo "<html><head><meta charset='UTF-8'><title>Approved Reward Claims</title>
    <style>
        body{font-family:Arial,sans-serif;padding:20px;color:#222;}
        h1{margin-bottom:5px;}
        p{margin-top:0;color:#555;}
        table{width:100%;border-collapse:collapse;margin-top:20px;}
        th,td{border:1px solid #ccc;padding:8px;text-align:left;font-size:12px;}
        th{background:#f2f2f2;}
    </style>
    </head><body>";

    echo "<h1>Approved Reward Claims</h1>";
    echo "<p>Generated on " . date('Y-m-d H:i:s') . "</p>";

    echo "<table>";
    echo "<tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Reward Type</th>
            <th>Payment</th>
            <th>Points</th>
            <th>Earnings</th>
            <th>Eligibility</th>
            <th>Status</th>
            <th>Date</th>
          </tr>";

    while ($claim = mysqli_fetch_assoc($result)) {
        $userId   = (int)($claim['user_id'] ?? 0);
        $points   = getUserContributionPoints($conn, $userId);
        $earnings = getUserTotalEarnings($points, $pointRate);
        $eligible = isEligibleForReward($points, $earnings, $pointsThreshold, $minimumCashout) ? 'Eligible' : 'Not Eligible';

        echo "<tr>
                <td>" . esc($claim['full_name']) . "</td>
                <td>" . esc($claim['email']) . "</td>
                <td>" . esc($claim['phone']) . "</td>
                <td>" . esc($claim['reward_type']) . "</td>
                <td>" . esc($claim['payment_method']) . "</td>
                <td>" . (int)$points . "</td>
                <td>$" . number_format($earnings, 2) . "</td>
                <td>" . esc($eligible) . "</td>
                <td>" . esc($claim['status']) . "</td>
                <td>" . esc($claim['created_at']) . "</td>
              </tr>";
    }

    echo "</table>";
    echo "</body></html>";
    exit;
}

/* =====================================================
   FETCH CLAIMS
===================================================== */
$sql = "SELECT * FROM reward_claims ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$claims = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reward Claims</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 md:p-10">

<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold">Reward Claims</h1>
            <p class="text-gray-600 mt-1">Manage reward claims and download approved users.</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="admin_reward_claim.php?export=excel"
               class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl font-semibold shadow">
                Download Excel
            </a>

            <a href="admin_reward_claim.php?export=pdf"
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl font-semibold shadow">
                Download PDF
            </a>
        </div>
    </div>

    <?php if ($message !== ""): ?>
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 font-medium">
            <?php echo esc($message); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-xl rounded-2xl overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-4">Name</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Phone</th>
                    <th class="p-4">Points</th>
                    <th class="p-4">Estimated Earnings</th>
                    <th class="p-4">Eligible</th>
                    <th class="p-4">Reward Type</th>
                    <th class="p-4">Payment</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Date</th>
                    <th class="p-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($claims)): ?>
                    <?php foreach ($claims as $claim): ?>
                        <?php
                            $userId   = (int)($claim['user_id'] ?? 0);
                            $points   = getUserContributionPoints($conn, $userId);
                            $earnings = getUserTotalEarnings($points, $pointRate);
                            $eligible = isEligibleForReward($points, $earnings, $pointsThreshold, $minimumCashout);
                        ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4"><?php echo esc($claim['full_name']); ?></td>
                            <td class="p-4"><?php echo esc($claim['email']); ?></td>
                            <td class="p-4"><?php echo esc($claim['phone']); ?></td>
                            <td class="p-4 font-semibold"><?php echo (int)$points; ?></td>
                            <td class="p-4 text-blue-600 font-semibold">$<?php echo number_format($earnings, 2); ?></td>
                            <td class="p-4 font-semibold <?php echo $eligible ? 'text-green-600' : 'text-red-600'; ?>">
                                <?php echo $eligible ? 'Yes' : 'No'; ?>
                            </td>
                            <td class="p-4"><?php echo esc($claim['reward_type']); ?></td>
                            <td class="p-4"><?php echo esc($claim['payment_method']); ?></td>
                            <td class="p-4 font-semibold
                                <?php
                                    if (($claim['status'] ?? '') === "Approved") echo "text-green-600";
                                    elseif (($claim['status'] ?? '') === "Rejected") echo "text-red-600";
                                    else echo "text-yellow-600";
                                ?>">
                                <?php echo esc($claim['status'] ?? 'Pending'); ?>
                            </td>
                            <td class="p-4"><?php echo esc($claim['created_at']); ?></td>
                            <td class="p-4">
                                <?php if (($claim['status'] ?? 'Pending') === "Pending"): ?>
                                    <div class="flex gap-2">
                                        <a href="?approve=<?php echo (int)$claim['id']; ?>"
                                           onclick="return confirm('Approve this claim?')"
                                           class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs">
                                            Approve
                                        </a>
                                        <a href="?reject=<?php echo (int)$claim['id']; ?>"
                                           onclick="return confirm('Reject this claim?')"
                                           class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs">
                                            Reject
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-400 text-xs">No action</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="p-6 text-center text-gray-500">No reward claims found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>