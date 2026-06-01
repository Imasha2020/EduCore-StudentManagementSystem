<?php 
// 1. Include Global Structural Elements, Authentication & Role Checks
include 'header.php'; 

// 2. Process Post Request Payload Form Submissions Safely
$message_status = "";
$message_class = "";

if (isset($_POST['add_course'])) {
    $course_name = mysqli_real_escape_string($data, trim($_POST['course_name']));
    $course_code = mysqli_real_escape_string($data, trim($_POST['course_code']));
    $description = mysqli_real_escape_string($data, trim($_POST['description']));
    $duration    = mysqli_real_escape_string($data, trim($_POST['duration']));

    if (!empty($course_name) && !empty($course_code)) {
        // Verify code conflict integrity to maintain data uniqueness restrictions
        $check_query = "SELECT id FROM course WHERE course_code = '$course_code'";
        $check_result = mysqli_query($data, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message_status = "Error: A course with this Course Code already exists in the system.";
            $message_class = "alert-danger";
        } else {
            // Apply standard baseline database insertion
            $insert_query = "INSERT INTO course (course_name, course_code, description, duration) 
                            VALUES ('$course_name', '$course_code', '$description', '$duration')";
            
            if (mysqli_query($data, $insert_query)) {
                $message_status = "Success: The course has been created successfully.";
                $message_class = "alert-success";
            } else {
                $message_status = "Database Error: " . mysqli_error($data);
                $message_class = "alert-danger";
            }
        }
    } else {
        $message_status = "Validation Error: Course Name and Course Code are mandatory requirements.";
        $message_class = "alert-danger";
    }
}

// 3. Include Responsive Structural Topbar Architecture
include 'navbar.php'; 

// 4. Include Left Navigation Controller
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
            <h4 class="fw-bold text-dark mb-1">Add Course</h4>
            <p class="text-muted small mb-0">Configure and deploy a new curriculum study course</p>
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
                
                <form action="" method="POST" autocomplete="off" class="needs-validation" novalidate>
                    <div class="row g-4">
                        
                        <div class="col-md-8">
                            <label class="form-label form-label-custom" for="courseName">Course Title</label>
                            <input type="text" name="course_name" class="form-control form-input-clean" id="courseName" placeholder="e.g., Introduction to Computer Science" required>
                            <div class="invalid-feedback">An official descriptive course title name is required.</div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label form-label-custom" for="courseCode">Course Code</label>
                            <input type="text" name="course_code" class="form-control form-input-clean" id="courseCode" placeholder="e.g., CS-101" required>
                            <div class="invalid-feedback">A unique code string identifier is required.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="courseDuration">Duration / Term Length</label>
                            <input type="text" name="duration" class="form-control form-input-clean" id="courseDuration" placeholder="e.g., 4 Months, 1 Semester, 3 Credits" required>
                            <div class="invalid-feedback">Please clarify operational execution timeframe parameters.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="courseDescription">Course Syllabus Description</label>
                            <textarea name="description" class="form-control form-input-clean" id="courseDescription" rows="5" placeholder="Outline clear curriculum subject pathways, study objectives, and grading milestones..." required></textarea>
                            <div class="invalid-feedback">Please include a clean context summary of the course blueprint.</div>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <div style="border-top: 1px solid #f1f5f9;"></div>
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                            <button type="reset" class="btn btn-light px-4 text-secondary border" style="font-size: 0.92rem;">Clear Form</button>
                            <button type="submit" name="add_course" class="btn btn-submit-clean px-4">
                                Save Course Record
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