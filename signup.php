<?php  
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "config.php";

/* -----------------------------
   GENERATE UNIQUE REFERRAL CODE
------------------------------*/
function generateUniqueReferralCode($conn, $length = 8) {
    do {
        $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

        $check = $conn->prepare("SELECT id FROM users WHERE referral_code = ?");
        $check->bind_param("s", $code);
        $check->execute();
        $check->store_result();

    } while ($check->num_rows > 0);

    $check->close();
    return $code;
}

/* -----------------------------
   EXTRACT REFERRAL FROM INPUT
------------------------------*/
function extractReferral($input) {
    $input = trim($input);

    if (filter_var($input, FILTER_VALIDATE_URL)) {
        $parts = parse_url($input);
        if (isset($parts['query'])) {
            parse_str($parts['query'], $query);
            if (isset($query['ref'])) {
                return strtoupper(trim($query['ref']));
            }
        }
    }

    return strtoupper($input);
}

$message = "";

/* -----------------------------
   AUTO PREFILL REF FROM URL
------------------------------*/
$prefill_ref = "";
if (isset($_GET['ref'])) {
    $prefill_ref = strtoupper(trim($_GET['ref']));
}

if (isset($_POST['btn_save'])) {

    $name     = trim($_POST['username']);
    $email    = strtolower(trim($_POST['useremail']));
    $phone    = trim($_POST['userphone']);
    $referral_input = extractReferral($_POST['referral'] ?? "");
    $password = $_POST['userpassword'];
    $confirm  = $_POST['confirmpass'];

    /* -----------------------------
       VALIDATION
    ------------------------------*/
    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm)) {
        $message = "Please fill all required fields";
    }
    elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $message = "Name must contain only letters and spaces";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address";
    }
    elseif (!preg_match("/^[0-9]{10,12}$/", $phone)) {
        $message = "Phone number must be 10–12 digits";
    }
    elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 characters";
    }
    elseif ($password !== $confirm) {
        $message = "Passwords do not match";
    }
    else {

        /* -----------------------------
           CHECK EXISTING EMAIL
        ------------------------------*/
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "Email already registered";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // ✅ FIXED FUNCTION CALL
            $referral_code = generateUniqueReferralCode($conn);

            $referrer_id = null;

            /* -----------------------------
               PROCESS REFERRAL INPUT
            ------------------------------*/
            if (!empty($referral_input) && strtolower($referral_input) !== $email) {

                if (filter_var($referral_input, FILTER_VALIDATE_EMAIL)) {
                    $refCheck = $conn->prepare("SELECT id FROM users WHERE LOWER(email) = ? LIMIT 1");
                    $refCheck->bind_param("s", $referral_input);
                } else {
                    $refCheck = $conn->prepare("SELECT id FROM users WHERE referral_code = ? LIMIT 1");
                    $refCheck->bind_param("s", $referral_input);
                }

                $refCheck->execute();
                $result = $refCheck->get_result();

                if ($result && $result->num_rows > 0) {
                    $refData = $result->fetch_assoc();
                    $referrer_id = (int)$refData['id'];
                }

                $refCheck->close();
            }

            /* -----------------------------
               INSERT USER
            ------------------------------*/
            $stmt = $conn->prepare("
                INSERT INTO users 
                (name, email, phone, password, role, referral_code, referred_by, referral_count, contribution_points)
                VALUES (?, ?, ?, ?, 'user', ?, ?, 0, 0)
            ");

            if (!$stmt) {
                $message = "Database error: " . $conn->error;
            } else {

                $stmt->bind_param(
                    "sssssi",
                    $name,
                    $email,
                    $phone,
                    $hashedPassword,
                    $referral_code,
                    $referrer_id
                );

                if ($stmt->execute()) {

                    $new_user_id = $stmt->insert_id;

                    /* -----------------------------
                       REFERRAL REWARD
                    ------------------------------*/
                    if (!empty($referrer_id) && $referrer_id != $new_user_id) {

                        // Increase referral count
                        $update = $conn->prepare("
                            UPDATE users 
                            SET referral_count = referral_count + 1 
                            WHERE id = ?
                        ");
                        $update->bind_param("i", $referrer_id);
                        $update->execute();
                        $update->close();

                        $points = 50;

                        // Log activity
                        $activity = $conn->prepare("
                            INSERT INTO user_activity (user_id, activity_type, points_earned, status)
                            VALUES (?, 'referral', ?, 'completed')
                        ");
                        $activity->bind_param("ii", $referrer_id, $points);
                        $activity->execute();
                        $activity->close();

                        // Update points
                        $updatePoints = $conn->prepare("
                            UPDATE users
                            SET contribution_points = contribution_points + ?
                            WHERE id = ?
                        ");
                        $updatePoints->bind_param("ii", $points, $referrer_id);
                        $updatePoints->execute();
                        $updatePoints->close();
                    }

                    $_SESSION['user_id'] = $new_user_id;
                    $_SESSION['email']   = $email;
                    $_SESSION['role']    = 'user';

                    header("Location: dashboarduser.php");
                    exit;

                } else {
                    $message = "Registration failed: " . $stmt->error;
                }

                $stmt->close();
            }
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Register</title>

<style>
body{
    font-family: Arial;
    background: #f5f5f5;
}
.container{
    width: 400px;
    margin: 60px auto;
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
input{
    width: 100%;
    padding: 10px;
    margin: 8px 0;
}
button{
    width: 100%;
    padding: 12px;
    background: #007bff;
    color: white;
    border: none;
}
.message{
    color: red;
}
</style>

</head>
<body>

<div class="container">

<h2>User Registration</h2>

<?php if ($message != "") { ?>
<div class="message"><?php echo htmlspecialchars($message); ?></div>
<?php } ?>

<form method="POST">

<input type="text" name="username" placeholder="Full Name" required>

<input type="email" name="useremail" placeholder="Email" required>

<input type="text" name="userphone" placeholder="Phone Number" required>

<input type="text" name="referral" placeholder="Referral (email, code, or link)" value="<?php echo htmlspecialchars($prefill_ref); ?>">

<input type="password" name="userpassword" placeholder="Password" required>

<input type="password" name="confirmpass" placeholder="Confirm Password" required>

<button type="submit" name="btn_save">Register</button>

</form>

</div>

</body>
</html>