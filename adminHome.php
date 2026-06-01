<?php 
// Include Global Structural Elements & Auth Checks
include 'header.php'; 
include 'navbar.php'; 
include 'sidebar.php'; 

// Example dynamic counts (replace with database queries when ready)
$total_students = "--";
$total_teachers = "--";
$total_courses = "--";
$pending_admissions = "--";
?>

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
                        <h2 class="fw-bold text-dark mb-0"><?php echo $total_students; ?></h2>
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
                        <h2 class="fw-bold text-dark mb-0"><?php echo $total_teachers; ?></h2>
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
                        <h2 class="fw-bold text-dark mb-0"><?php echo $total_courses; ?></h2>
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
                        <h2 class="fw-bold text-dark mb-0"><?php echo $pending_admissions; ?></h2>
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

<?php 
// Include UI Footer Termination Script Elements
include 'footer.php'; 
?>