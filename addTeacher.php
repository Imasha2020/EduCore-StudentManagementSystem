<?php 
// 1. Include Global Structural Elements, Authentication & Role Checks
include 'header.php'; 

// 2. Process Post Request Payload Form Submissions Safely
$message_status = "";
$message_class = "";

if (isset($_POST['add_teacher'])) {
    $teacher_name = mysqli_real_escape_string($data, trim($_POST['name']));
    $teacher_desc = mysqli_real_escape_string($data, trim($_POST['description']));
    
    // File Upload Handler Setup
    $file = $_FILES['image']['name'];
    
    // Define target folder directory path
    $target_dir = "./image/";
    
    // Automated Check: Create directory with safe permission parameters if missing
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    // Sanitize filename to prevent issues with spaces or special characters
    $clean_filename = time() . '_' . str_replace(' ', '_', $file);
    
    $dst = $target_dir . $clean_filename;
    $dst_db = "image/" . $clean_filename; // Location path string stored in your DB column

    if (!empty($teacher_name)) {
        
        // Move the file payload safely now that directory presence is verified
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dst)) {
            
            // Database Insertion matching phpMyAdmin schema: name, description, image
            $insert_query = "INSERT INTO teacher (name, description, image) VALUES ('$teacher_name', '$teacher_desc', '$dst_db')";
            
            if (mysqli_query($data, $insert_query)) {
                $message_status = "Success: Teacher account profile record configured successfully.";
                $message_class = "alert-success";
            } else {
                $message_status = "Database Insertion Failure: " . mysqli_error($data);
                $message_class = "alert-danger";
            }
        } else {
            $message_status = "Storage Allocation Error: Failed to write uploaded image asset to disk destination.";
            $message_class = "alert-danger";
        }
    } else {
        $message_status = "Validation Error: Faculty Member baseline Name configuration cannot be empty.";
        $message_class = "alert-danger";
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
            <h4 class="fw-bold text-dark mb-1">Add Teacher</h4>
            <p class="text-muted small mb-0">Create a new faculty profile record</p>
        </div>
        <div>
            <a href="view_teachers.php" class="btn btn-sm btn-outline-secondary px-3">
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
                
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
                    <div class="row g-4">
                        
                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="teacherName">Teacher Name</label>
                            <input type="text" name="name" class="form-control form-input-clean" id="teacherName" placeholder="e.g., Prof. Jane Doe" required>
                            <div class="invalid-feedback">Faculty baseline name is required.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="teacherDescription">Description / Bio</label>
                            <textarea name="description" class="form-control form-input-clean" id="teacherDescription" rows="4" placeholder="Department track focus and tenure milestones description details..." required></textarea>
                            <div class="invalid-feedback">Please include a clean educational summary background.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="teacherImage">Profile Image Photo Asset</label>
                            <input type="file" name="image" class="form-control form-input-clean" id="teacherImage" accept="image/*" required>
                            <div class="invalid-feedback">A clear physical digital image rendering asset is mandatory.</div>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <div style="border-top: 1px solid #f1f5f9;"></div>
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                            <button type="reset" class="btn btn-light px-4 text-secondary" style="font-size: 0.92rem; border: 1px solid #e2e8f0;">Clear Form</button>
                            <button type="submit" name="add_teacher" class="btn btn-submit-clean px-4">
                                Save Teacher Record
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