<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Global Authentication & Role Check
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['usertype'] != "admin") {
    header("Location: login.php");
    exit();
}

// 2. Global Database Connection
$host = 'localhost';
$user = "root";
$password = "";
$db = "educore";

$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore Admin Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --brand-primary: #2563eb;
            --brand-dark: #1e3a8a;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --body-bg: #f0f4f9;
            --card-border: #dbeafe;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Top Navbar */
        .topbar {
            background: #ffffff;
            border-bottom: 2px solid var(--card-border);
            z-index: 1030;
        }

        .brand-text {
            background: linear-gradient(45deg, var(--brand-primary), var(--brand-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: var(--sidebar-bg);
            min-height: calc(100vh - 74px);
            transition: all 0.3s ease;
            box-shadow: inset -1px 0 0 rgba(255, 255, 255, 0.05);
        }

        .sidebar-title {
            color: #60a5fa;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.12rem;
            padding: 24px 24px 10px;
            font-weight: 700;
        }

        .sidebar a {
            color: #93c5fd;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 13px 24px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
            color: #ffffff;
            border-left-color: #60a5fa;
        }

        .sidebar a.active {
            background-color: #1d4ed8;
            color: #ffffff;
            border-left-color: #38bdf8;
            font-weight: 600;
        }

        .sidebar i {
            font-size: 1.2rem;
            margin-right: 12px;
            color: #93c5fd;
            transition: color 0.2s;
        }

        .sidebar a:hover i, .sidebar a.active i {
            color: #ffffff;
        }

        /* Modern Blue Dashboard Cards */
        .card-stat {
            border: 1px solid var(--card-border);
            border-radius: 14px;
            background: #ffffff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.08) !important;
        }

        .icon-shape {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.6rem;
        }

        .bg-blue-subtle { background-color: #eff6ff; color: #1d4ed8; }
        .bg-indigo-subtle { background-color: #f5f3ff; color: #6d28d9; }
        .bg-sky-subtle { background-color: #f0f9ff; color: #0369a1; }
        .bg-teal-subtle { background-color: #f0fdf4; color: #0f766e; }

        .main-content {
            padding: 40px 32px;
        }

        .card-custom {
            border: 1px solid var(--card-border);
            border-radius: 14px;
            background: #ffffff;
        }
        
        .card-custom .card-header {
            border-bottom: 1px solid var(--card-border);
        }

        @media (max-width: 767.98px) {
            .sidebar { min-height: auto; }
            .main-content { padding: 24px 16px; }
        }
    </style>
</head>
<body>