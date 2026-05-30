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
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>EduCore Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<style>

body{
    background:#f4f7fc;
}

/* Top Navbar */
.topbar{
    background:white;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

/* Sidebar */
.sidebar{
    min-height:100vh;
    background:#0d6efd;
}

.sidebar-title{
    color:white;
    text-align:center;
    padding:20px;
    border-bottom:1px solid rgba(255,255,255,0.2);
}

.sidebar a{
    color:white;
    text-decoration:none;
    display:block;
    padding:15px 20px;
    transition:0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.15);
}

.sidebar i{
    margin-right:10px;
}

/* Dashboard Cards */
.card-dashboard{
    border:none;
    border-radius:15px;
}

.card-dashboard .card-body{
    text-align:center;
}

/* Main Content */
.main-content{
    padding:30px;
}

</style>

</head>
<body>

<!-- ===================== TOP NAVBAR ===================== -->

<nav class="navbar navbar-expand-lg navbar-light topbar">

    <div class="container-fluid">

        <h3 class="fw-bold text-primary mb-0">
            <i class="bi bi-mortarboard-fill"></i>
            EduCore Admin Dashboard
        </h3>

        <div>

            <span class="fw-semibold me-3">

                Welcome,
                <?php echo $_SESSION['username']; ?>

            </span>

            <a href="logout.php" class="btn btn-danger">

                <i class="bi bi-box-arrow-right"></i>
                Logout

            </a>

        </div>

    </div>

</nav>

<!-- ===================== PAGE CONTENT ===================== -->

<div class="container-fluid">

    <div class="row">

        <!-- ===================== SIDEBAR ===================== -->

        <div class="col-md-3 col-lg-2 sidebar p-0">

            <h4 class="sidebar-title">
                Admin Panel
            </h4>

            <a href="adminHome.php">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>

            <a href="admissions.php">
                <i class="bi bi-file-earmark-text"></i>
                Admissions
            </a>

            <a href="addStudent.php">
                <i class="bi bi-person-plus"></i>
                Add Student
            </a>

            <a href="viewStudents.php">
                <i class="bi bi-people"></i>
                View Students
            </a>

            <a href="addTeacher.php">
                <i class="bi bi-person-workspace"></i>
                Add Teacher
            </a>

            <a href="viewTeachers.php">
                <i class="bi bi-person-badge"></i>
                View Teachers
            </a>

            <a href="addCourse.php">
                <i class="bi bi-book-half"></i>
                Add Course
            </a>

            <a href="viewCourses.php">
                <i class="bi bi-journal-bookmark"></i>
                View Courses
            </a>

        </div>

        <!-- ===================== MAIN CONTENT ===================== -->

        <div class="col-md-9 col-lg-10 main-content">

            <h2 class="fw-bold mb-4">
                Dashboard Overview
            </h2>

            <!-- Statistics Cards -->

            <div class="row g-4">

                <div class="col-md-3">

                    <div class="card card-dashboard shadow bg-primary text-white">

                        <div class="card-body">

                            <!-- Future Database Count -->

                            <h2>--</h2>

                            <p>Total Students</p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card card-dashboard shadow bg-success text-white">

                        <div class="card-body">

                            <!-- Future Database Count -->

                            <h2>--</h2>

                            <p>Total Teachers</p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card card-dashboard shadow bg-warning text-dark">

                        <div class="card-body">

                            <!-- Future Database Count -->

                            <h2>--</h2>

                            <p>Total Courses</p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card card-dashboard shadow bg-danger text-white">

                        <div class="card-body">

                            <!-- Future Database Count -->

                            <h2>--</h2>

                            <p>Pending Admissions</p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Welcome Card -->

            <div class="card shadow mt-5">

                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">
                        Welcome to EduCore
                    </h5>

                </div>

                <div class="card-body">

                    <h4>
                        Hello,
                        <?php echo $_SESSION['username']; ?>
                    </h4>

                    <p class="text-muted">

                        Welcome to the EduCore Administration Dashboard.

                        Use the menu on the left to manage all educational activities.

                    </p>

                    <hr>

                    <div class="row">

                        <div class="col-md-6">

                            <h6 class="fw-bold">
                                Student Management
                            </h6>

                            <ul>

                                <li>Student Admissions</li>
                                <li>Add Students</li>
                                <li>View Students</li>

                            </ul>

                        </div>

                        <div class="col-md-6">

                            <h6 class="fw-bold">
                                Academic Management
                            </h6>

                            <ul>

                                <li>Add Teachers</li>
                                <li>Manage Courses</li>
                                <li>Generate Reports</li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Recent Activity Section -->

            <div class="card shadow mt-4">

                <div class="card-header bg-light">

                    <h5 class="mb-0">
                        Recent Activities
                    </h5>

                </div>

                <div class="card-body text-center">

                    <i class="bi bi-clock-history fs-1 text-secondary"></i>

                    <p class="mt-3 text-muted">

                        No recent activities available.

                        <br><br>

                        This section will display:

                    </p>

                    <ul class="list-unstyled">

                        <li>New Admissions</li>
                        <li>New Student Registrations</li>
                        <li>Teacher Updates</li>
                        <li>Course Updates</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>