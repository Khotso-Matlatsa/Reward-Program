<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f8;
}
.login-box {
    width: 350px;
    margin: 100px auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,.15);
}
.login-box h2 {
    text-align: center;
    margin-bottom: 20px;
}
.login-box input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
}
.login-box button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
.login-btn {
    background: #2563eb;
    color: #fff;
}
.login-btn:hover {
    background: #1e40af;
}
.create-btn {
    background: #e5e7eb;
    margin-top: 10px;
}
.create-btn:hover {
    background: #d1d5db;
}
.error {
    background: #fee2e2;
    color: #b91c1c;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    text-align: center;
}
.divider {
    text-align: center;
    margin: 15px 0;
    color: #6b7280;
}
</style>
</head>

<body>

<div class="login-box">
    <h2>Login</h2>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="useremail" placeholder="Email" required>
        <input type="password" name="userpassword" placeholder="Password" required>
        <button type="submit" name="btn_login" class="login-btn">Login</button>
    </form>

    <div class="divider">OR</div>

    <!-- CREATE ACCOUNT -->
    <form action="register.php" method="GET">
        <button type="submit" class="create-btn">Create Account</button>
    </form>
</div>

</body>
</html>
