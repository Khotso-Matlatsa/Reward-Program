<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

/* ---------- ALREADY LOGGED IN ---------- */
if (isset($_SESSION['user_id'], $_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: dashboard2.php");
    } else {
        header("Location: dashboarduser.php");
    }
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_login'])) {

    $email    = trim(filter_var($_POST['useremail'], FILTER_SANITIZE_EMAIL));
    $password = $_POST['userpassword'];

    if ($email === '' || $password === '') {
        $error = "Email and password are required";
    } else {

        $stmt = $conn->prepare("
            SELECT id, email, password, role
            FROM users
            WHERE email = ?
            LIMIT 1
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                // ✅ SET SESSION
                $_SESSION['user_id'] = (int)$user['id'];
                $_SESSION['role']    = $user['role'];

                // ✅ REDIRECT BY ROLE
                if ($user['role'] === 'admin') {
                    header("Location: dashboard2.php");
                } else {
                    header("Location: dashboarduser.php");
                }
                exit;

            } else {
                $error = "Invalid email or password";
            }

        } else {
            $error = "Invalid email or password";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Quicks</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

<style>
* { box-sizing: border-box; }

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #2563eb, #1e40af);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-box {
    width: 360px;
    background: #fff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 20px 40px rgba(0,0,0,.25);
    animation: slideUp .7s ease;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
}

.login-box h2 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
}

.field { margin-bottom: 20px; }

.field input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    outline: none;
}

.field input:focus {
    border-color: #2563eb;
}

.login-btn {
    width: 100%;
    padding: 12px;
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all .2s;
}

.login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(37,99,235,.4);
}

.create-btn {
    width: 100%;
    margin-top: 12px;
    padding: 12px;
    background: transparent;
    border: 1px solid #2563eb;
    color: #2563eb;
    border-radius: 8px;
    cursor: pointer;
}

.create-btn:hover {
    background: #2563eb;
    color: #fff;
}

.divider {
    text-align: center;
    margin: 20px 0;
    font-size: 13px;
    color: #6b7280;
}

.error {
    background: #fee2e2;
    color: #991b1b;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    text-align: center;
    animation: shake .3s;
}

@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    50% { transform: translateX(4px); }
    75% { transform: translateX(-4px); }
    100% { transform: translateX(0); }
}
</style>
</head>

<body>

<div class="login-box">
    <h2>Welcome Back</h2>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <div class="field">
            <input type="email" name="useremail" placeholder="Email" required>
        </div>

        <div class="field">
            <input type="password" name="userpassword" placeholder="Password" required>
        </div>

        <button class="login-btn" type="submit" name="btn_login">
            Login
        </button>
    </form>

    <div class="divider">New here?</div>

    <form action="register.php" method="GET">
        <button class="create-btn" type="submit">
            Create Account
        </button>
    </form>
</div>

</body>
</html>
