<?php 
// 1. Include Global Structural Elements, Authentication & Role Checks
include 'header.php'; 

// 2. Process Post Request Payload Form Submissions Safely
$message_status = "";
$message_class = "";

if (isset($_POST['add_student'])) {
    $student_user = mysqli_real_escape_string($data, trim($_POST['username']));
    $student_email = mysqli_real_escape_string($data, trim($_POST['email']));
    $student_phone = mysqli_real_escape_string($data, trim($_POST['phone']));
    $student_pass = $_POST['password']; 
    
    // Check if user credentials conflict with existing records
    $check_query = "SELECT * FROM user WHERE username = '$student_user' OR email = '$student_email'";
    $check_result = mysqli_query($data, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $message_status = "Error: Username or Email already exists in the system.";
        $message_class = "alert-danger";
    } else {
        // Secure password string before saving
        $hashed_password = password_hash($student_pass, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO user (username, phone, email, usertype, password) VALUES ('$student_user', '$student_phone', '$student_email', 'student', '$hashed_password')";
        
        if (mysqli_query($data, $insert_query)) {
            $message_status = "Success: Student account has been created successfully.";
            $message_class = "alert-success";
        } else {
            $message_status = "Database Error: " . mysqli_error($data);
            $message_class = "alert-danger";
        }
    }
}

// 3. Include Responsive Structural Topbar Architecture
include 'navbar.php'; 

// 4. Include Left Navigation Controller
include 'sidebar.php'; 
?>

<style>
    /* Minimal Dashboard Topbar */
    .page-title-box {
        padding-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    /* Clean Enterprise Card Layout */
    .form-container-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    /* Standard Form Labeling & Fields */
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

    .form-input-clean::placeholder {
        color: #94a3b8;
    }

    .form-input-clean:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    /* Clean Corporate Button Matrix */
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
        border-color: #1d4ed8;
        color: #ffffff;
    }

    .btn-submit-clean:active {
        background-color: #1e40af;
    }
</style>

<div class="col-md-9 ms-sm-auto col-lg-10 main-content">
    
    <div class="page-title-box d-flex justify-content-between align-items-center flex-wrap gap-2 mt-2 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Add Student</h4>
            <p class="text-muted small mb-0">Create a new student profile record</p>
        </div>
        <div>
            <a href="view_admissions.php" class="btn btn-sm btn-outline-secondary px-3">
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
                        
                        <div class="col-md-6">
                            <label class="form-label form-label-custom" for="studentUsername">Username</label>
                            <input type="text" name="username" class="form-control form-input-clean" id="studentUsername" placeholder="e.g., john_doe" required>
                            <div class="invalid-feedback">A unique profile username string is required.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label form-label-custom" for="studentEmail">Email Address</label>
                            <input type="email" name="email" class="form-control form-input-clean" id="studentEmail" placeholder="name@domain.com" required>
                            <div class="invalid-feedback">Please enter a valid electronic mailing address.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label form-label-custom" for="studentPhone">Phone Number</label>
                            <input type="tel" name="phone" class="form-control form-input-clean" id="studentPhone" placeholder="e.g., +1234567890" required>
                            <div class="invalid-feedback">A reliable primary contact link is required.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label form-label-custom" for="studentPassword">Password</label>
                            <input type="password" name="password" class="form-control form-input-clean" id="studentPassword" placeholder="••••••••" required>
                            <div class="invalid-feedback">Please enter an account access security password.</div>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <div style="border-top: 1px solid #f1f5f9;"></div>
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                            <button type="reset" class="btn btn-light px-4 text-secondary" style="font-size: 0.92rem; border: 1px solid #e2e8f0;">Clear Form</button>
                            <button type="submit" name="add_student" class="btn btn-submit-clean px-4">
                                Save Student Record
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
// 5. Close Layout Framework & Terminate Scripts Element
include 'footer.php'; 
?>