<?php 
// 1. Enforce strict session validation checks before generating layout streams
include 'header.php'; 

// Make sure that an admin cannot view this page or a non-logged user isn't breaking parameters
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'student') {
    // If your DB uses a different tag like 'user', change 'student' to match your schema string
    header("Location: login.php");
    exit();
}

// 2. Query personal student profile metrics securely
$active_user = mysqli_real_escape_string($data, $_SESSION['username']);
$profile_query = "SELECT * FROM user WHERE username = '$active_user' LIMIT 1";
$profile_result = mysqli_query($data, $profile_query);
$student_data = mysqli_fetch_assoc($profile_result);

// 3. Include Modular Viewport Components
include 'StudentNavBar.php'; 
include 'StudentSidebar.php'; 
?>

<!-- Main Display Workspace Panel -->
<div class="col-md-9 ms-sm-auto col-lg-10 main-content px-md-4" style="padding-top: 24px;">
    
    <!-- Greeting Context Banner Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 pb-3 border-bottom">
        <div>
            <h2 class="fw-bold text-dark mb-1">Student Workspace</h2>
            <p class="text-muted small mb-0">Welcome back! Access your customized study tracking metrics and course syllabuses here.</p>
        </div>
    </div>

    <!-- Overview Statistics Dashboard Row -->
    <div class="row g-4 mb-5">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0 rounded-3 p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-semibold mb-3">Academic Account Verified</span>
                <h3 class="fw-bold mb-2">Hello, <?php echo htmlspecialchars($student_data['username'] ?? 'Learner'); ?>!</h3>
                <p class="mb-4 opacity-75">You are securely logged into your personal portal space. Use the sidebar navigation menu tools to look over your profile settings or check current curriculum assignments.</p>
                
                <div class="row g-3 pt-3 border-top border-white border-opacity-25 mt-2">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2 small">
                            <i class="bi bi-envelope-fill text-white-50"></i>
                            <span><?php echo htmlspecialchars($student_data['email'] ?? 'Not registered'); ?></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2 small">
                            <i class="bi bi-telephone-fill text-white-50"></i>
                            <span><?php echo htmlspecialchars($student_data['phone'] ?? 'No phone added'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Metric Card Blocks -->
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border h-100 p-4 bg-white rounded-3 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="text-uppercase text-muted fw-bold tracking-wider small mb-0">Course Overview</h6>
                        <div class="icon-shape p-2 bg-light text-primary rounded">
                            <i class="bi bi-journal-text fs-5"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Active Term</h3>
                    <p class="text-muted small mb-0">You can view your assigned subjects and class schedules inside your curriculum registry profile block.</p>
                </div>
                <div class="pt-3">
                    <a href="studentCourses.php" class="btn btn-primary w-100 py-2 rounded-2 fw-medium">
                        <i class="bi bi-search me-1"></i> View My Course Details
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php 
// 4. Include structural ending script markers
include 'StudentFooter.php'; 
?>