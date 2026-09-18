<?php
session_start();
require_once 'config.php';

$message = "";
$messageType = "success";

/* -----------------------------
LOGIN CHECK
------------------------------ */
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please login first.");
}

$userId = (int) $_SESSION['user_id'];

/* -----------------------------
SYSTEM SETTINGS
------------------------------ */
$pointsThreshold = 500;
$cashThreshold   = 5.00;

/* -----------------------------
GET USER DATA
------------------------------ */
$userPoints = 0;
$userName   = "";
$userEmail  = "";
$userPhone  = "";

$userQuery = "SELECT * FROM users WHERE id = $userId LIMIT 1";
$userResult = mysqli_query($conn, $userQuery);

if ($userResult && mysqli_num_rows($userResult) > 0) {
    $userRow = mysqli_fetch_assoc($userResult);

    $userPoints = (int)($userRow['contribution_points'] ?? 0);

    if (isset($userRow['name'])) {
        $userName = $userRow['name'];
    } elseif (isset($userRow['full_name'])) {
        $userName = $userRow['full_name'];
    } elseif (isset($userRow['username'])) {
        $userName = $userRow['username'];
    }

    $userEmail = $userRow['email'] ?? '';
    $userPhone = $userRow['phone'] ?? '';
}

/* -----------------------------
CALCULATE USER EARNINGS FROM user_activity
------------------------------ */
$views = 0;
$likes = 0;
$scrolls = 0;
$videoWatches = 0;
$surveyCompletions = 0;
$referrals = 0;
$businessReferrals = 0;

/* views */
$qViews = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM user_activity
    WHERE user_id = $userId
      AND status = 'completed'
      AND (
            activity_type = 'view'
            OR activity_name LIKE '%view%'
          )
");
if ($qViews) {
    $views = (int)(mysqli_fetch_assoc($qViews)['total'] ?? 0);
}

/* likes */
$qLikes = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM user_activity
    WHERE user_id = $userId
      AND status = 'completed'
      AND (
            activity_type = 'like'
            OR activity_name LIKE '%like%'
          )
");
if ($qLikes) {
    $likes = (int)(mysqli_fetch_assoc($qLikes)['total'] ?? 0);
}

/* scrolls */
$qScrolls = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM user_activity
    WHERE user_id = $userId
      AND status = 'completed'
      AND (
            activity_type = 'scroll'
            OR activity_name LIKE '%scroll%'
          )
");
if ($qScrolls) {
    $scrolls = (int)(mysqli_fetch_assoc($qScrolls)['total'] ?? 0);
}

/* video watches */
$qVideos = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM user_activity
    WHERE user_id = $userId
      AND status = 'completed'
      AND (
            activity_type = 'video_watch'
            OR activity_name LIKE '%video%'
            OR activity_name LIKE '%watch%'
          )
");
if ($qVideos) {
    $videoWatches = (int)(mysqli_fetch_assoc($qVideos)['total'] ?? 0);
}

/* survey completions */
$qSurveys = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM user_activity
    WHERE user_id = $userId
      AND status = 'completed'
      AND (
            activity_type = 'survey'
            OR activity_type = 'survey_complete'
            OR activity_name LIKE '%survey%'
          )
");
if ($qSurveys) {
    $surveyCompletions = (int)(mysqli_fetch_assoc($qSurveys)['total'] ?? 0);
}

/* referrals */
$qReferrals = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM user_activity
    WHERE user_id = $userId
      AND status = 'completed'
      AND (
            activity_type = 'referral'
            OR activity_name LIKE '%referral%'
          )
");
if ($qReferrals) {
    $referrals = (int)(mysqli_fetch_assoc($qReferrals)['total'] ?? 0);
}

/* business referrals */
$qBusinessRefs = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM user_activity
    WHERE user_id = $userId
      AND status = 'completed'
      AND (
            activity_type = 'business_referral'
            OR activity_name LIKE '%business%'
          )
");
if ($qBusinessRefs) {
    $businessReferrals = (int)(mysqli_fetch_assoc($qBusinessRefs)['total'] ?? 0);
}

/* -----------------------------
EARNINGS RULES
------------------------------ */
$referralEarnings      = $referrals * 0.001;
$imageActivityEarnings = ($views + $likes + $scrolls) * 0.001;
$videoEarnings         = $videoWatches * 0.002;
$surveyEarnings        = $surveyCompletions * 0.001;
$businessBonus         = $businessReferrals * 0.10;

/* 15% of referred users' earnings
   only if users table has total_earnings
*/
$referralBonus = 0.00;
$checkTotalEarningsCol = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'total_earnings'");
if ($checkTotalEarningsCol && mysqli_num_rows($checkTotalEarningsCol) > 0) {
    $qReferralBonus = mysqli_query($conn, "
        SELECT COALESCE(SUM(total_earnings), 0) AS total
        FROM users
        WHERE referred_by = $userId
    ");
    if ($qReferralBonus) {
        $referredTotal = (float)(mysqli_fetch_assoc($qReferralBonus)['total'] ?? 0);
        $referralBonus = $referredTotal * 0.15;
    }
}

/* Most active user bonus = 50% of own earnings */
$topUserId = 0;
$qTopUser = mysqli_query($conn, "
    SELECT user_id, COUNT(*) AS total
    FROM user_activity
    WHERE status = 'completed'
    GROUP BY user_id
    ORDER BY total DESC
    LIMIT 1
");
if ($qTopUser && mysqli_num_rows($qTopUser) > 0) {
    $topRow = mysqli_fetch_assoc($qTopUser);
    $topUserId = (int)($topRow['user_id'] ?? 0);
}

$baseEarnings = $referralEarnings + $imageActivityEarnings + $videoEarnings + $surveyEarnings + $referralBonus + $businessBonus;
$mostActiveBonus = ($userId === $topUserId) ? ($baseEarnings * 0.50) : 0.00;
$totalEarnings = $baseEarnings + $mostActiveBonus;

/* -----------------------------
OPTIONAL: USE points_earned FROM user_activity
If contribution_points in users is 0, fallback to sum(points_earned)
------------------------------ */
if ($userPoints <= 0) {
    $qPoints = mysqli_query($conn, "
        SELECT COALESCE(SUM(points_earned), 0) AS total_points
        FROM user_activity
        WHERE user_id = $userId
          AND status = 'completed'
    ");
    if ($qPoints) {
        $userPoints = (int)(mysqli_fetch_assoc($qPoints)['total_points'] ?? 0);
    }
}

/* -----------------------------
ELIGIBILITY
User can claim if:
1. contribution bar is filled
OR
2. total earnings reach $5
------------------------------ */
$canClaim = ($userPoints >= $pointsThreshold || $totalEarnings >= $cashThreshold);

/* -----------------------------
CHECK IF reward_claims HAS user_id COLUMN
------------------------------ */
$rewardClaimsHasUserId = false;
$checkUserIdCol = mysqli_query($conn, "SHOW COLUMNS FROM reward_claims LIKE 'user_id'");
if ($checkUserIdCol && mysqli_num_rows($checkUserIdCol) > 0) {
    $rewardClaimsHasUserId = true;
}

/* -----------------------------
CHECK EXISTING PENDING CLAIM
------------------------------ */
$hasPendingClaim = false;

if ($rewardClaimsHasUserId) {
    $pendingCheck = mysqli_query($conn, "
        SELECT id
        FROM reward_claims
        WHERE user_id = $userId
          AND status = 'Pending'
        LIMIT 1
    ");
} else {
    $safeEmail = mysqli_real_escape_string($conn, $userEmail);
    $pendingCheck = mysqli_query($conn, "
        SELECT id
        FROM reward_claims
        WHERE email = '$safeEmail'
          AND status = 'Pending'
        LIMIT 1
    ");
}

if ($pendingCheck && mysqli_num_rows($pendingCheck) > 0) {
    $hasPendingClaim = true;
    $canClaim = false;
}

/* -----------------------------
HANDLE CLAIM SUBMISSION
------------------------------ */
if (isset($_POST['claim'])) {

    if (!$canClaim) {
        $message = "You are not yet eligible to claim rewards.";
        $messageType = "error";
    } else {
        $name    = mysqli_real_escape_string($conn, trim($_POST['fullname'] ?? ''));
        $email   = mysqli_real_escape_string($conn, trim($_POST['email'] ?? ''));
        $phone   = mysqli_real_escape_string($conn, trim($_POST['phone'] ?? ''));
        $reward  = mysqli_real_escape_string($conn, trim($_POST['reward_type'] ?? ''));
        $payment = mysqli_real_escape_string($conn, trim($_POST['payment_method'] ?? ''));

        if ($name === "" || $email === "" || $phone === "" || $reward === "" || $payment === "") {
            $message = "Please fill in all fields.";
            $messageType = "error";
        } else {
            if ($rewardClaimsHasUserId) {
                $checkDuplicate = mysqli_query($conn, "
                    SELECT id
                    FROM reward_claims
                    WHERE user_id = $userId
                      AND status = 'Pending'
                    LIMIT 1
                ");
            } else {
                $checkDuplicate = mysqli_query($conn, "
                    SELECT id
                    FROM reward_claims
                    WHERE email = '$email'
                      AND status = 'Pending'
                    LIMIT 1
                ");
            }

            if ($checkDuplicate && mysqli_num_rows($checkDuplicate) > 0) {
                $message = "You already have a pending reward claim.";
                $messageType = "error";
            } else {
                if ($rewardClaimsHasUserId) {
                    $sql = "
                        INSERT INTO reward_claims
                        (user_id, full_name, email, phone, reward_type, payment_method, status)
                        VALUES
                        ($userId, '$name', '$email', '$phone', '$reward', '$payment', 'Pending')
                    ";
                } else {
                    $sql = "
                        INSERT INTO reward_claims
                        (full_name, email, phone, reward_type, payment_method, status)
                        VALUES
                        ('$name', '$email', '$phone', '$reward', '$payment', 'Pending')
                    ";
                }

                if (mysqli_query($conn, $sql)) {
                    $message = "Reward claim submitted successfully!";
                    $messageType = "success";
                    $hasPendingClaim = true;
                    $canClaim = false;
                } else {
                    $message = "Something went wrong: " . mysqli_error($conn);
                    $messageType = "error";
                }
            }
        }
    }
}

/* -----------------------------
PROGRESS
------------------------------ */
$pointsProgress   = ($pointsThreshold > 0) ? min(100, ($userPoints / $pointsThreshold) * 100) : 0;
$earningsProgress = ($cashThreshold > 0) ? min(100, ($totalEarnings / $cashThreshold) * 100) : 0;

$pointsRemaining = max(0, $pointsThreshold - $userPoints);
$cashRemaining   = max(0, $cashThreshold - $totalEarnings);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Rewards</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto p-6 md:p-10 grid md:grid-cols-2 gap-10">

    <!-- LEFT PANEL -->
    <div class="bg-teal-500 text-white p-8 rounded-2xl shadow-xl">
        <h2 class="text-3xl font-bold mb-4">Reward Progress</h2>

        <p class="mb-6 text-lg">
            Complete activities such as surveys, watching videos, viewing media, scrolling, liking, and referrals to unlock rewards.
        </p>

        <!-- POINTS CARD -->
        <div class="bg-white/20 p-5 rounded-xl mb-5">
            <p class="text-lg font-semibold">
                Contribution Points: <?php echo $userPoints; ?> / <?php echo $pointsThreshold; ?>
            </p>

            <div class="w-full bg-white/30 rounded-full h-4 mt-3 overflow-hidden">
                <div class="bg-white h-4 rounded-full transition-all duration-500" style="width: <?php echo $pointsProgress; ?>%"></div>
            </div>

            <p class="mt-3 text-sm">
                Progress: <?php echo number_format($pointsProgress, 1); ?>%
            </p>

            <?php if ($userPoints < $pointsThreshold) { ?>
                <p class="mt-2 text-sm text-yellow-100">
                    Complete <?php echo $pointsRemaining; ?> more points to unlock rewards by points.
                </p>
            <?php } else { ?>
                <p class="mt-2 text-sm text-green-100 font-semibold">
                    Contribution points target reached.
                </p>
            <?php } ?>
        </div>

        <!-- EARNINGS CARD -->
        <div class="bg-white/20 p-5 rounded-xl mb-5">
            <p class="text-lg font-semibold">
                Total Earnings: $<?php echo number_format($totalEarnings, 2); ?> / $<?php echo number_format($cashThreshold, 2); ?>
            </p>

            <div class="w-full bg-white/30 rounded-full h-4 mt-3 overflow-hidden">
                <div class="bg-yellow-300 h-4 rounded-full transition-all duration-500" style="width: <?php echo $earningsProgress; ?>%"></div>
            </div>

            <p class="mt-3 text-sm">
                Earnings Progress: <?php echo number_format($earningsProgress, 1); ?>%
            </p>

            <?php if ($totalEarnings < $cashThreshold) { ?>
                <p class="mt-2 text-sm text-yellow-100">
                    Earn $<?php echo number_format($cashRemaining, 2); ?> more to unlock rewards by earnings.
                </p>
            <?php } else { ?>
                <p class="mt-2 text-sm text-green-100 font-semibold">
                    Earnings target reached.
                </p>
            <?php } ?>
        </div>

        <!-- BREAKDOWN -->
        <div class="mt-4 text-sm bg-black/10 rounded-xl p-4 space-y-1">
            <p>Views: <?php echo $views; ?></p>
            <p>Likes: <?php echo $likes; ?></p>
            <p>Scrolls: <?php echo $scrolls; ?></p>
            <p>Video watches: <?php echo $videoWatches; ?></p>
            <p>Survey completions: <?php echo $surveyCompletions; ?></p>
            <p>Referrals: <?php echo $referrals; ?></p>
            <p>Business referrals: <?php echo $businessReferrals; ?></p>

            <hr class="my-2 border-white/20">

            <p>Referral earnings: $<?php echo number_format($referralEarnings, 3); ?></p>
            <p>Image engagement earnings: $<?php echo number_format($imageActivityEarnings, 3); ?></p>
            <p>Video earnings: $<?php echo number_format($videoEarnings, 3); ?></p>
            <p>Survey earnings: $<?php echo number_format($surveyEarnings, 3); ?></p>
            <p>Referral bonus (15%): $<?php echo number_format($referralBonus, 3); ?></p>
            <p>Business bonus (10%): $<?php echo number_format($businessBonus, 3); ?></p>
            <p>Most active bonus: $<?php echo number_format($mostActiveBonus, 3); ?></p>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl">
        <h2 class="text-3xl font-bold mb-6">Claim Reward</h2>

        <?php if ($message !== "") { ?>
            <div class="mb-4 p-3 rounded-xl text-center <?php echo ($messageType === 'success') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <?php if ($hasPendingClaim) { ?>
            <div class="mb-4 p-3 rounded-xl bg-yellow-100 text-yellow-800 text-center">
                You already have a pending reward claim. Please wait for admin review.
            </div>
        <?php } ?>

        <form method="POST" class="space-y-5">

            <input
                type="text"
                name="fullname"
                placeholder="Your names"
                value="<?php echo htmlspecialchars($userName); ?>"
                class="w-full border p-3 rounded-xl"
                required
            >

            <input
                type="email"
                name="email"
                placeholder="Enter email"
                value="<?php echo htmlspecialchars($userEmail); ?>"
                class="w-full border p-3 rounded-xl"
                required
            >

            <input
                type="text"
                name="phone"
                placeholder="Phone number"
                value="<?php echo htmlspecialchars($userPhone); ?>"
                class="w-full border p-3 rounded-xl"
                required
            >

            <select name="reward_type" class="w-full border p-3 rounded-xl" required>
                <option value="">Select reward type</option>
                <option value="Referral">Referral</option>
                <option value="Task">Task</option>
                <option value="Loyalty">Loyalty</option>
                <option value="Business">Business</option>
            </select>

            <select name="payment_method" class="w-full border p-3 rounded-xl" required>
                <option value="">Preferred payment method</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="PayPal">PayPal</option>
                <option value="Mpesa">Mpesa</option>
                <option value="EcoCash">EcoCash</option>
            </select>

            <p class="text-sm text-gray-500">
                NB: Verify entered details. Information provided here will be used for payment.
            </p>

            <div class="p-4 rounded-xl <?php echo $canClaim ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-700'; ?>">
                <?php if ($canClaim) { ?>
                    Eligible: You can now claim because
                    <?php echo ($userPoints >= $pointsThreshold) ? 'your contribution points bar is filled' : 'your total earnings reached $5'; ?>.
                <?php } else { ?>
                    Locked: Fill the contribution points bar or reach $5 total earnings to become eligible.
                <?php } ?>
            </div>

            <button
                type="submit"
                name="claim"
                <?php if (!$canClaim) echo "disabled"; ?>
                class="w-full py-3 rounded-xl font-semibold <?php echo $canClaim ? 'bg-green-600 hover:bg-green-700 text-white' : 'bg-gray-400 text-white cursor-not-allowed'; ?>">
                <?php echo $canClaim ? 'Claim Reward' : 'Locked - Not Eligible'; ?>
            </button>
        </form>
    </div>
</div>

</body>
</html>