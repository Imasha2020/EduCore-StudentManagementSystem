<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['usertype'] != "admin") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Home</title>
</head>
<body>

<h1>Welcome Admin</h1>

<p>
Logged in as:
<?php echo $_SESSION['username']; ?>
</p>

</body>
</html>