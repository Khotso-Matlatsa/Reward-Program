<?php
/****************************
 * PREVENT MULTIPLE INCLUDES
 ****************************/
if (defined('APP_CONFIG_LOADED')) {
    return;
}
define('APP_CONFIG_LOADED', true);

/****************************
 * DATABASE CONFIG
 ****************************/
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ecommerce";
$port = 3308;

/****************************
 * SAFE CONSTANTS
 ****************************/
if (!defined('PLAYERLIST_URL')) {
    define('PLAYERLIST_URL', '/quicks/dashboard/playerlist.php');
}

/****************************
 * DATABASE CONNECTION
 ****************************/
$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

/****************************
 * SESSION HANDLING
 ****************************/
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/****************************
 * AUTH HELPERS
 ****************************/
if (!function_exists('requireLogin')) {
    function requireLogin() {
        if (empty($_SESSION['user_id'])) {
            header("Location: /quicks/logins.php");
            exit;
        }
    }
}

if (!function_exists('requireAdmin')) {
    function requireAdmin() {
        requireLogin();
        if (($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: /quicks/dashboarduser.php");
            exit;
        }
    }
}

/****************************
 * SESSION DATA HELPERS
 ****************************/
if (!function_exists('currentUserEmail')) {
    function currentUserEmail() {
        return $_SESSION['email'] ?? '';
    }
}

if (!function_exists('currentUserFullname')) {
    function currentUserFullname() {
        return $_SESSION['fullname'] ?? '';
    }
}

/****************************
 * ACTIVITY POINT SYSTEM
 ****************************/
if (!function_exists('activity_points')) {

    function activity_points($conn, $user_id, $activity_type)
    {
        $points_map = [
            "view" => 1,
            "scroll" => 1,
            "like" => 3,
            "comment" => 4,
            "survey" => 20,
            "app_install" => 25
        ];

        if (!isset($points_map[$activity_type])) {
            return false;
        }

        $points = $points_map[$activity_type];

        /* SAVE ACTIVITY */
        $stmt = $conn->prepare("
            INSERT INTO user_activity (user_id, activity_type, points_earned, created_at)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->bind_param("isi", $user_id, $activity_type, $points);
        $stmt->execute();

        /* UPDATE USER POINTS */
        $stmt2 = $conn->prepare("
            UPDATE users
            SET contribution_points = contribution_points + ?
            WHERE id = ?
        ");
        $stmt2->bind_param("ii", $points, $user_id);
        $stmt2->execute();

        return true;
    }
}