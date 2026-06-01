<!-- Student Header Navigation Component -->
<nav class="navbar navbar-expand-lg topbar sticky-top py-3" style="background: #ffffff; border-bottom: 1px solid #e2e8f0;">
    <div class="container-fluid px-4">
        <h3 class="fw-bold d-flex align-items-center gap-2 mb-0 fs-4">
            <i class="bi bi-mortarboard-fill text-primary fs-3"></i>
            <span class="brand-text text-dark">EduCore</span>
        </h3>
        
        <button class="navbar-toggler border-0 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-none d-lg-flex align-items-center">
            <span class="text-muted me-3" style="font-size: 0.88rem;">
                <i class="bi bi-shield-lock-fill text-success me-1"></i> Student Portal: <strong class="text-dark"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Student'); ?></strong>
            </span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm px-4 rounded-pill fw-medium">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">