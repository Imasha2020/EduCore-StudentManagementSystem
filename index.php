<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore - Student Management System</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">

            <a class="navbar-brand fw-bold fs-3" href="#">
                <i class="bi bi-mortarboard-fill"></i> EduCore
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item mx-2">
                        <a class="nav-link active" href="#">Home</a>
                    </li>

                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Courses</a>
                    </li>

                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Admission</a>
                    </li>

                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                    <li class="nav-item ms-3">
                        <a href="login.php" class="btn btn-light text-primary fw-semibold px-4">
                            Login
                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold text-primary">
                        Student Management System
                    </h1>

                    <p class="lead text-muted mt-3">
                        Manage students, courses, enrollments, grades, and attendance
                        efficiently through one centralized platform.
                    </p>

                    <div class="mt-4">
                        <a href="#" class="btn btn-primary btn-lg me-2">
                            Get Started
                        </a>

                        <a href="#" class="btn btn-outline-primary btn-lg">
                            Learn More
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 text-center mt-4 mt-lg-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png"
                         class="img-fluid"
                         style="max-height: 350px;"
                         alt="Student Management">
                </div>

            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Key Features</h2>
            <p class="text-muted">Everything you need to manage academic activities.</p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-person-plus-fill fs-1 text-primary"></i>
                        <h5 class="mt-3">Student Registration</h5>
                        <p class="text-muted">
                            Register and manage student profiles easily.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-book-fill fs-1 text-success"></i>
                        <h5 class="mt-3">Course Enrollment</h5>
                        <p class="text-muted">
                            Allow students to enroll in courses online.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-bar-chart-fill fs-1 text-danger"></i>
                        <h5 class="mt-3">Grades & Attendance</h5>
                        <p class="text-muted">
                            Track academic performance and attendance records.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">
            © 2026 EduCore Student Management System
        </p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>