<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['usertype'] != "student") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Home</title>
</head>
<body>

<h1>Welcome Student</h1>

<p>
Logged in as:
<?php echo $_SESSION['username']; ?>
</p>

</body>
</html>