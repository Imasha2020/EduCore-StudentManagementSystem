<?php 
// 1. Include Global Structural Elements, Authentication & Role Checks
include 'header.php'; 

$message_status = "";
$message_class = "";

// Ensure a valid operational record identification target parameter is active
if (isset($_GET['id'])) {
    $course_id = mysqli_real_escape_string($data, $_GET['id']);
    
    $select_query = "SELECT * FROM course WHERE id = '$course_id'";
    $result = mysqli_query($data, $select_query);
    $course = mysqli_fetch_assoc($result);
    
    if (!$course) {
        header("Location: viewCourses.php");
        exit();
    }
} else {
    header("Location: viewCourses.php");
    exit();
}

// 2. Process Post Modification Modification Request Payloads
if (isset($_POST['update_course'])) {
    $course_name = mysqli_real_escape_string($data, trim($_POST['course_name']));
    $course_code = mysqli_real_escape_string($data, trim($_POST['course_code']));
    $description = mysqli_real_escape_string($data, trim($_POST['description']));
    $duration    = mysqli_real_escape_string($data, trim($_POST['duration']));

    if (!empty($course_name) && !empty($course_code)) {
        
        // Ensure modifying the course code string doesn't create collisions with OTHER existing rows
        $collision_query = "SELECT id FROM course WHERE course_code = '$course_code' AND id != '$course_id'";
        $collision_result = mysqli_query($data, $collision_query);

        if (mysqli_num_rows($collision_result) > 0) {
            $message_status = "Conflict Error: The specified Course Code is already explicitly claimed by another registry entry.";
            $message_class = "alert-danger";
        } else {
            // Apply targeted operational database system updates
            $update_query = "UPDATE course SET 
                            course_name = '$course_name', 
                            course_code = '$course_code', 
                            description = '$description', 
                            duration = '$duration' 
                            WHERE id = '$course_id'";
            
            if (mysqli_query($data, $update_query)) {
                $message_status = "Success: Course configuration structures modified successfully.";
                $message_class = "alert-success";
                
                // Re-pull active tracking values to keep interface synced
                $select_query = "SELECT * FROM course WHERE id = '$course_id'";
                $result = mysqli_query($data, $select_query);
                $course = mysqli_fetch_assoc($result);
            } else {
                $message_status = "Database System Execution Failure: " . mysqli_error($data);
                $message_class = "alert-danger";
            }
        }
    } else {
        $message_status = "Validation Failure: Title maps and indexing tracking codes cannot be null.";
        $message_class = "alert-danger";
    }
}

// 3. Render Interface Elements
include 'navbar.php'; 
include 'sidebar.php'; 
?>

<style>
    .page-title-box {
        padding-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-container-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .form-label-custom {
        font-size: 0.87rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }

    .form-input-clean {
        font-size: 0.92rem;
        padding: 10px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        color: #0f172a;
        background-color: #ffffff;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .form-input-clean:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    .btn-submit-clean {
        background-color: #2563eb;
        color: #ffffff;
        border: 1px solid #2563eb;
        border-radius: 6px;
        padding: 10px 24px;
        font-size: 0.92rem;
        font-weight: 500;
        transition: background-color 0.15s ease;
    }

    .btn-submit-clean:hover {
        background-color: #1d4ed8;
    }
</style>

<div class="col-md-9 ms-sm-auto col-lg-10 main-content">
    
    <div class="page-title-box d-flex justify-content-between align-items-center flex-wrap gap-2 mt-2 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Update Course Details</h4>
            <p class="text-muted small mb-0">Modify institutional syllabus parameters and track metrics</p>
        </div>
        <div>
            <a href="viewCourses.php" class="btn btn-sm btn-outline-secondary px-3">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    <?php if(!empty($message_status)): ?>
        <div class="alert <?php echo $message_class; ?> alert-dismissible fade show border-0 rounded-2 p-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <span class="small fw-medium"><?php echo $message_status; ?></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xl-8 col-lg-10">
            <div class="form-container-card p-4 p-md-5 mb-5">
                
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="row g-4">
                        
                        <div class="col-md-8">
                            <label class="form-label form-label-custom" for="courseName">Course Title</label>
                            <input type="text" name="course_name" class="form-control form-input-clean" id="courseName" 
                                   value="<?php echo htmlspecialchars($course['course_name']); ?>" required>
                            <div class="invalid-feedback">An active course title name mapping is mandatory.</div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label form-label-custom" for="courseCode">Course Code</label>
                            <input type="text" name="course_code" class="form-control form-input-clean" id="courseCode" 
                                   value="<?php echo htmlspecialchars($course['course_code']); ?>" required>
                            <div class="invalid-feedback">Course tracking code metrics string is required.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="courseDuration">Duration / Term Length</label>
                            <input type="text" name="duration" class="form-control form-input-clean" id="courseDuration" 
                                   value="<?php echo htmlspecialchars($course['duration']); ?>" required>
                            <div class="invalid-feedback">Syllabus duration timeframe configurations are required.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="courseDescription">Course Syllabus Description</label>
                            <textarea name="description" class="form-control form-input-clean" id="courseDescription" rows="5" required><?php echo htmlspecialchars($course['description']); ?></textarea>
                            <div class="invalid-feedback">Please retain a clear description context background layout block.</div>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <div style="border-top: 1px solid #f1f5f9;"></div>
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                            <a href="viewCourses.php" class="btn btn-light px-4 text-secondary border" style="font-size: 0.92rem;">Cancel Changes</a>
                            <button type="submit" name="update_course" class="btn btn-submit-clean px-4">
                                Save Course Updates
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const validationForms = document.querySelectorAll('.needs-validation');
        Array.from(validationForms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>

<?php 
include 'footer.php'; 
?>