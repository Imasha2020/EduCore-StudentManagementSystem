<?php

error_reporting(0);
 session_start();

$host = 'localhost';
$user = "root";
$password = "";
$db = "educore";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);

    if($row['usertype'] == "admin") {
        $_SESSION['username'] = $username;
        $_SESSION['usertype'] = "admin";
        header("Location: adminHome.php");
        exit();
    } else if($row['usertype'] == "student") {
        $_SESSION['username'] = $username;
        $_SESSION['usertype'] = "student";
        header("Location: studentHome.php");
        exit();
    } else {
        $message = "Invalid username or password";
        $_SESSION['loginMessage'] = $message;
        header("Location: login.php");
        exit();
    }
}
?>