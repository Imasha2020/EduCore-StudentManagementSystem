<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore - Student Management System</title>

    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        /* Form Custom Design */
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
        }
        
        .card-admission {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm py-3">
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
                        <a class="nav-link" href="#admission-section">Admission</a>
                    </li>

                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                    <li class="nav-item ms-3">
                        <a href="login.php" class="btn btn-light text-primary fw-semibold px-4 rounded-pill">
                            Login
                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-light py-5 border-bottom">
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
                        <a href="#admission-section" class="btn btn-primary btn-lg me-2 px-4 rounded-pill">
                            Get Started
                        </a>

                        <a href="#" class="btn btn-outline-primary btn-lg px-4 rounded-pill">
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

    <!-- Features Section -->
    <section class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Key Features</h2>
            <p class="text-muted">Everything you need to manage academic activities.</p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0 p-3">
                    <div class="card-body text-center">
                        <div class="p-3 bg-primary-subtle text-primary d-inline-block rounded-circle mb-3">
                            <i class="bi bi-person-plus-fill fs-1"></i>
                        </div>
                        <h5 class="fw-bold">Student Registration</h5>
                        <p class="text-muted mb-0">
                            Register and manage student profiles easily.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0 p-3">
                    <div class="card-body text-center">
                        <div class="p-3 bg-success-subtle text-success d-inline-block rounded-circle mb-3">
                            <i class="bi bi-book-fill fs-1"></i>
                        </div>
                        <h5 class="fw-bold">Course Enrollment</h5>
                        <p class="text-muted mb-0">
                            Allow students to enroll in courses online.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0 p-3">
                    <div class="card-body text-center">
                        <div class="p-3 bg-danger-subtle text-danger d-inline-block rounded-circle mb-3">
                            <i class="bi bi-bar-chart-fill fs-1"></i>
                        </div>
                        <h5 class="fw-bold">Grades & Attendance</h5>
                        <p class="text-muted mb-0">
                            Track academic performance and attendance records.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ===================== ADMISSION FORM SECTION ===================== -->
    <section id="admission-section" class="bg-light py-5 border-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    
                    <div class="text-center mb-5">
                        <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-2 rounded-pill fw-semibold">Application Portal</span>
                        <h2 class="fw-bold text-dark">Online Admission Form</h2>
                        <p class="text-muted">Submit your application information below to initiate the enrollment process.</p>
                    </div>

                    <div class="card card-admission shadow-sm p-4 p-md-5">
                        <form action="process_admission.php" method="POST">
                            
                            <div class="row g-4">
                                <!-- Name Input -->
                                <div class="col-12">
                                    <label for="fullName" class="form-label fw-semibold text-dark">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control py-2.5" id="fullName" name="name" placeholder="John Doe" required>
                                    </div>
                                </div>

                                <!-- Email Input -->
                                <div class="col-md-6">
                                    <label for="emailAddress" class="form-label fw-semibold text-dark">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control py-2.5" id="emailAddress" name="email" placeholder="johndoe@example.com" required>
                                    </div>
                                </div>

                                <!-- Phone Input -->
                                <div class="col-md-6">
                                    <label for="phoneNumber" class="form-label fw-semibold text-dark">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i class="bi bi-telephone"></i></span>
                                        <input type="tel" class="form-control py-2.5" id="phoneNumber" name="phone" placeholder="+1 (555) 000-0000" required>
                                    </div>
                                </div>

                                <!-- Message Input -->
                                <div class="col-12">
                                    <label for="coverMessage" class="form-label fw-semibold text-dark">Message / Statement of Purpose</label>
                                    <textarea class="form-control" id="coverMessage" name="message" rows="4" placeholder="Tell us about your educational background and course goals..." required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                    s                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm" name="apply">
                                        <i class="bi bi-send-fill me-2"></i> Apply Now
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white-50 text-center py-4">
        <div class="container">
            <p class="mb-0 small">
                © 2026 EduCore Student Management System. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>