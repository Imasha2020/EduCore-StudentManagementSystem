<?php
// 1. MUST BE LINE 1: Configure anti-tracking cookie framework parameters before session initialization
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '', 
        'secure' => false, 
        'httponly' => true,
        'samesite' => 'Lax' 
    ]);
    session_start();
}

// Suppress runtime notices for clean, secure execution in production environments
error_reporting(0);

$host = 'localhost';
$user = "root";
$password = "";
$db = "educore";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = mysqli_real_escape_string($data, trim($_POST['username']));
    $password = trim($_POST['password']); 

    // Find the record profile securely using only the username first
    $sql = "SELECT * FROM `user` WHERE `username`='$username' LIMIT 1";
    $result = mysqli_query($data, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // 2. Comprehensive Multi-tier Password Verification Gate
        // - Tier 1: password_verify() -> Explicitly handles your secure PASSWORD_DEFAULT hashes from add_student.php
        // - Tier 2: plain text comparison -> Supports any legacy/test users typed raw in phpMyAdmin
        // - Tier 3: md5 fallback -> Prevents legacy breakage if any users used older encryption types
        if (password_verify($password, $row['password']) || $password === $row['password'] || md5($password) === $row['password']) {
            
            // Clean up old error flags upon successful authentication validation
            unset($_SESSION['loginMessage']);
            
            $_SESSION['username'] = $row['username'];
            
            // Format incoming role identifier values cleanly to eliminate case issues
            $role = strtolower(trim($row['usertype']));
            $_SESSION['usertype'] = $role;

            // 3. Robust Role-Based Routing Matrix Endpoints
            if ($role === "admin") {
                header("Location: adminHome.php");
                exit();
            } else if ($role === "student") {
                header("Location: studentHome.php");
                exit();
            } else {
                $_SESSION['loginMessage'] = "Access Refused: Role profile '$role' is unmapped in this system.";
                header("Location: login.php");
                exit();
            }

        } else {
            $_SESSION['loginMessage'] = "Authentication Error: Incorrect password.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['loginMessage'] = "Authentication Error: Username not found.";
        header("Location: login.php");
        exit();
    }
}
?>