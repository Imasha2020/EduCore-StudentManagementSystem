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

        /* Blue Theme Highlights */
        .bg-blue-subtle { background-color: #eff6ff; color: #1d4ed8; }
        .bg-indigo-subtle { background-color: #f5f3ff; color: #6d28d9; }
        .bg-sky-subtle { background-color: #f0f9ff; color: #0369a1; }
        .bg-teal-subtle { background-color: #f0fdf4; color: #0f766e; }

        /* Content Area */
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

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .sidebar {
                min-height: auto;
            }
            .main-content {
                padding: 24px 16px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg topbar sticky-top py-3">
    <div class="container-fluid px-4">
        <h3 class="fw-bold d-flex align-items-center gap-2 mb-0 fs-4">
            <i class="bi bi-mortarboard-fill text-primary fs-3"></i>
            <span class="brand-text">EduCore</span>
        </h3>
        
        <button class="navbar-toggler border-0 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-none d-lg-flex align-items-center">
            <span class="text-muted me-3">
                <i class="bi bi-person-badge-fill text-primary me-1"></i> Security Context: <strong class="text-dark"><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
            </span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm px-4 rounded-pill fw-medium">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

//Sidebar 
<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 col-lg-2 sidebar p-0 collapse d-md-block" id="sidebarMenu">
            <div class="sticky-top" style="top: 85px;">
                <div class="sidebar-title">Core Features</div>
                
                <a href="adminHome.php" class="active">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
                <a href="admissions.php">
                    <i class="bi bi-file-earmark-text-fill"></i> Admissions
                </a>

                <div class="sidebar-title">Management</div>
                <a href="addStudent.php">
                    <i class="bi bi-person-plus-fill"></i> Add Student
                </a>
                <a href="viewStudents.php">
                    <i class="bi bi-people-fill"></i> View Students
                </a>
                <a href="addTeacher.php">
                    <i class="bi bi-person-video3"></i> Add Teacher
                </a>
                <a href="viewTeachers.php">
                    <i class="bi bi-person-bounding-box"></i> View Teachers
                </a>
                <a href="addCourse.php">
                    <i class="bi bi-book-half"></i> Add Course
                </a>
                <a href="viewCourses.php">
                    <i class="bi bi-journal-bookmark-fill"></i> View Courses
                </a>
                
                <div class="d-lg-none border-top border-secondary mt-4 pt-2">
                    <a href="logout.php" class="text-danger fw-bold">
                        <i class="bi bi-box-arrow-right text-danger"></i> Secure Logout
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9 ms-sm-auto col-lg-10 main-content">
            
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <h2 class="fw-bold tracking-tight text-dark mb-1">Administrative Center</h2>
                    <p class="text-muted small mb-0">Unified telemetry overview and dynamic core configuration panels.</p>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card-stat shadow-sm p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted text-uppercase fs-7 fw-semibold tracking-wider mb-1">Total Students</p>
                                <h2 class="fw-bold text-dark mb-0">--</h2>
                            </div>
                            <div class="icon-shape bg-blue-subtle">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card-stat shadow-sm p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted text-uppercase fs-7 fw-semibold tracking-wider mb-1">Total Teachers</p>
                                <h2 class="fw-bold text-dark mb-0">--</h2>
                            </div>
                            <div class="icon-shape bg-indigo-subtle">
                                <i class="bi bi-person-video3"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card-stat shadow-sm p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted text-uppercase fs-7 fw-semibold tracking-wider mb-1">Total Courses</p>
                                <h2 class="fw-bold text-dark mb-0">--</h2>
                            </div>
                            <div class="icon-shape bg-sky-subtle">
                                <i class="bi bi-book-half"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card-stat shadow-sm p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted text-uppercase fs-7 fw-semibold tracking-wider mb-1">Pending Admissions</p>
                                <h2 class="fw-bold text-dark mb-0">--</h2>
                            </div>
                            <div class="icon-shape bg-teal-subtle">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="card card-custom shadow-sm h-100">
                        <div class="card-body p-4">
                            <span class="badge bg-primary px-3 py-2 rounded-pill fw-semibold mb-3">Enterprise Active</span>
                            <h4 class="fw-bold text-dark mb-2">
                                Welcome Back, <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </h4>
                            <p class="text-muted">
                                This dashboard delivers secure control vectors across your educational infrastructure. Monitor and adjust dynamic parameters via the core sidebar directory.
                            </p>
                            
                            <div class="border-top pt-4 mt-4">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <h6 class="fw-bold text-primary mb-2">
                                            <i class="bi bi-shield-check me-2"></i>Student Operations
                                        </h6>
                                        <ul class="text-muted small ps-4 mb-0">
                                            <li class="mb-1">Process dynamic system intakes</li>
                                            <li class="mb-1">Provision global registry records</li>
                                            <li>Audit database student matrices</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 class="fw-bold text-primary mb-2">
                                            <i class="bi bi-cpu me-2"></i>Academic Matrix
                                        </h6>
                                        <ul class="text-muted small ps-4 mb-0">
                                            <li class="mb-1">Roster specialized institutional faculties</li>
                                            <li class="mb-1">Curate system course architectures</li>
                                            <li>Compile real-time administrative logs</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card card-custom shadow-sm h-100">
                        <div class="card-header bg-transparent pt-4 px-4 pb-0">
                            <h5 class="fw-bold text-dark mb-0">System Activity Logs</h5>
                        </div>
                        <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="p-3 bg-blue-subtle rounded-circle mb-3">
                                <i class="bi bi-clock-history fs-3"></i>
                            </div>
                            <p class="text-dark fw-semibold mb-1">Queue Clear</p>
                            <p class="text-muted small mb-0 px-3">
                                As updates manifest within the system pipeline (Admissions, registrations, updates), real-time logs will populate this segment automatically.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>