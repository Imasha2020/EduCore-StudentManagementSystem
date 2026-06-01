<?php 
// 1. Include Global Structural Elements & Auth Checks
include 'header.php'; 

// 2. Fetch Live Telemetry Data Metrics from Database
// (Assuming $data is your active mysqli connection variable established in header.php)

// A. Get count of active student records
$student_query = "SELECT COUNT(*) as total FROM user WHERE usertype = 'student'";
$student_result = mysqli_query($data, $student_query);
$total_students = ($student_result) ? mysqli_fetch_assoc($student_result)['total'] : 0;

// B. Get count of registered faculty records
$teacher_query = "SELECT COUNT(*) as total FROM teacher";
$teacher_result = mysqli_query($data, $teacher_query);
$total_teachers = ($teacher_result) ? mysqli_fetch_assoc($teacher_result)['total'] : 0;

// C. Get count of deployed course records
$course_query = "SELECT COUNT(*) as total FROM course";
$course_result = mysqli_query($data, $course_query);
$total_courses = ($course_query) ? mysqli_fetch_assoc($course_result)['total'] : 0;

// D. Get count of pending entries (Adjust table name if using an exclusive 'admission' table)
$admission_query = "SELECT COUNT(*) as total FROM user WHERE usertype = 'admission' OR usertype = 'pending'";
$admission_result = mysqli_query($data, $admission_query);
$pending_admissions = ($admission_result) ? mysqli_fetch_assoc($admission_result)['total'] : 0;


// 3. Include Structural Layout Viewports
include 'navbar.php'; 
include 'sidebar.php'; 
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
            <div class="card-stat shadow-sm p-4" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase fs-7 fw-semibold tracking-wider mb-1" style="font-size:0.78rem;">Total Students</p>
                        <h2 class="fw-bold text-dark mb-0"><?php echo number_format($total_students); ?></h2>
                    </div>
                    <div class="icon-shape p-3 rounded-3" style="background-color: #eff6ff; color: #2563eb;">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card-stat shadow-sm p-4" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase fs-7 fw-semibold tracking-wider mb-1" style="font-size:0.78rem;">Total Teachers</p>
                        <h2 class="fw-bold text-dark mb-0"><?php echo number_format($total_teachers); ?></h2>
                    </div>
                    <div class="icon-shape p-3 rounded-3" style="background-color: #e0e7ff; color: #4f46e5;">
                        <i class="bi bi-person-video3 fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card-stat shadow-sm p-4" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase fs-7 fw-semibold tracking-wider mb-1" style="font-size:0.78rem;">Total Courses</p>
                        <h2 class="fw-bold text-dark mb-0"><?php echo number_format($total_courses); ?></h2>
                    </div>
                    <div class="icon-shape p-3 rounded-3" style="background-color: #f0f9ff; color: #0284c7;">
                        <i class="bi bi-book-half fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card-stat shadow-sm p-4" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase fs-7 fw-semibold tracking-wider mb-1" style="font-size:0.78rem;">Pending Applications</p>
                        <h2 class="fw-bold text-dark mb-0"><?php echo number_format($pending_admissions); ?></h2>
                    </div>
                    <div class="icon-shape p-3 rounded-3" style="background-color: #f0fdf4; color: #16a34a;">
                        <i class="bi bi-file-earmark-text-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm h-100" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:12px;">
                <div class="card-body p-4">
                    <span class="badge bg-primary px-3 py-2 rounded-pill fw-semibold mb-3">Enterprise System Operational</span>
                    <h4 class="fw-bold text-dark mb-2">
                        Welcome Back, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Administrator'); ?>
                    </h4>
                    <p class="text-muted">
                        This dashboard delivers secure control vectors across your educational infrastructure. Monitor analytics metrics, process intakes, and adjust dynamic parameters via the core sidebar directory.
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
            <div class="card shadow-sm h-100" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:12px;">
                <div class="card-header bg-transparent pt-4 px-4 pb-0 border-0">
                    <h5 class="fw-bold text-dark mb-0">System Activity Logs</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="p-3 bg-light text-primary rounded-circle mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <p class="text-dark fw-semibold mb-1">Queue Clear</p>
                    <p class="text-muted small mb-0 px-3">
                        As new modifications manifest within the system architecture (Admissions processed, teacher records added, course details updated), transaction histories will populate this segment automatically.
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