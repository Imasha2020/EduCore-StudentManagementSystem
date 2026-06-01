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

// Process the admission form submission
if (isset($_POST['apply'])) {
    // Retrieve form data
    $data_name = $_POST['name'];
    $data_email = $_POST['email'];
    $data_phone = $_POST['phone'];
    $data_message = $_POST['message'];

    // Perform validation and processing (example: save to database)
    $sql = "INSERT INTO admission (name, email, phone, message) VALUES ('$data_name', '$data_email', '$data_phone', '$data_message')";
    $result = mysqli_query($data, $sql);
    if ($result) {
        echo "Admission application submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($data);
    }   

    // Redirect or display success message
    header("Location: admission_success.php");
    exit();
}
?>