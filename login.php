<?php
// 1. Configure anti-tracking, modern cookie parameters BEFORE session initialization
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '', 
        'secure' => false,     // Set to true later if you migrate to a live production HTTPS domain
        'httponly' => true,    // Restricts JavaScript accessibility to neutralize XSS injection paths
        'samesite' => 'Lax'    // Permits cross-navigation cookie allowance while blocking tracker blocks
    ]);
    session_start();
}

// Suppress runtime error output markers on display wrappers
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #4f9bff);
            min-height: 100vh;
        }

        .login-container {
            min-height: 100vh;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .left-panel {
            background: white;
            padding: 50px;
        }

        .right-panel {
            background: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
        }

        .logo {
            font-size: 2rem;
            color: #0d6efd;
        }

        .form-control {
            height: 50px;
        }

        .btn-login {
            height: 50px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container login-container d-flex align-items-center justify-content-center">
    <div class="row w-100">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg login-card">
                <div class="row g-0">
                    
                    <div class="col-md-6 left-panel">
                        <div class="text-center mb-4">
                            <i class="bi bi-mortarboard-fill logo"></i>
                            <h2 class="fw-bold mt-2">EduCore</h2>
                            <p class="text-muted">Student Management System</p>
                        </div>

                        <?php if (isset($_SESSION['loginMessage'])): ?>
                            <div class="alert alert-danger text-center border-0 py-2 small fw-medium">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                <?php 
                                    echo htmlspecialchars($_SESSION['loginMessage']); 
                                    unset($_SESSION['loginMessage']); 
                                ?>
                            </div>
                        <?php endif; ?>

                        <form action="login_check.php" method="POST" autocomplete="off">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary small">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary small">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label small text-muted" for="rememberMe">Remember Me</label>
                                </div>
                                <a href="#" class="text-decoration-none small fw-medium">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-login d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-box-arrow-in-right fs-5"></i> Login
                            </button>

                            <div class="text-center mt-4">
                                <p class="small text-muted mb-0">
                                    Don't have an account? 
                                    <a href="register.php" class="text-decoration-none fw-bold text-primary">Register Here</a>
                                </p>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 right-panel">
                        <i class="bi bi-mortarboard-fill display-1 mb-4"></i>
                        <h2 class="fw-bold text-center">Welcome Back!</h2>
                        <p class="text-center opacity-75 small px-3">
                            Access your courses, grades, attendance records and academic information through EduCore.
                        </p>
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png" class="img-fluid mt-4 d-none d-md-block" style="max-height: 220px;" alt="Student Framework Vector">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>