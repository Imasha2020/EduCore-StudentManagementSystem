<?php 
// 1. Include Global Structural Elements, Authentication & Role Checks
include 'header.php'; 

$message_status = "";
$message_class = "";

// Ensure a valid URL request configuration parameter exists
if (isset($_GET['id'])) {
    $teacher_id = mysqli_real_escape_string($data, $_GET['id']);
    
    // Fetch existing details for targeted instructor
    $select_query = "SELECT * FROM teacher WHERE id = '$teacher_id'";
    $result = mysqli_query($data, $select_query);
    $teacher = mysqli_fetch_assoc($result);
    
    if (!$teacher) {
        header("Location: viewTeacher.php");
        exit();
    }
} else {
    header("Location: viewTeacher.php");
    exit();
}

// 2. Process Post Request Payload Form Modification Safely
if (isset($_POST['update_teacher'])) {
    $teacher_name = mysqli_real_escape_string($data, trim($_POST['name']));
    $teacher_desc = mysqli_real_escape_string($data, trim($_POST['description']));
    
    // Dynamic asset extraction update validation variables
    $file = $_FILES['image']['name'];
    $dst_db = $teacher['image']; // Default fallback pointer to existing value if no new image is selected

    if (!empty($teacher_name)) {
        $upload_ok = true;

        // If user submitted a new file asset update request stream
        if (!empty($file)) {
            $target_dir = "./image/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            // Clean up special characters and prefix with a unique timestamp
            $clean_filename = time() . '_' . preg_replace("/[^A-Za-z0-9.\-_]/", '_', $file);
            $dst = $target_dir . $clean_filename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dst)) {
                // Delete old photo record from disk if valid file exists
                $old_file_path = "./" . $teacher['image'];
                if (!empty($teacher['image']) && file_exists($old_file_path) && !is_dir($old_file_path)) {
                    unlink($old_file_path);
                }
                $dst_db = "image/" . $clean_filename;
            } else {
                $upload_ok = false;
                $message_status = "Storage Allocation Error: Failed to write uploaded image asset.";
                $message_class = "alert-danger";
            }
        }

        if ($upload_ok) {
            // Apply Update modifications query command parameters
            $update_query = "UPDATE teacher SET name = '$teacher_name', description = '$teacher_desc', image = '$dst_db' WHERE id = '$teacher_id'";
            
            if (mysqli_query($data, $update_query)) {
                $message_status = "Success: Teacher account profile matrix modified successfully.";
                $message_class = "alert-success";
                
                // Refresh local session tracking variables to mirror modification changes
                $select_query = "SELECT * FROM teacher WHERE id = '$teacher_id'";
                $result = mysqli_query($data, $select_query);
                $teacher = mysqli_fetch_assoc($result);
            } else {
                $message_status = "Database Operation Failure: " . mysqli_error($data);
                $message_class = "alert-danger";
            }
        }
    } else {
        $message_status = "Validation Error: Faculty baseline identity mapping name cannot be empty.";
        $message_class = "alert-danger";
    }
}

// 3. Include Structural Layout Elements
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

    /* Interactive Current Asset Inline Preview Layout */
    .preview-badge-box {
        background-color: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 6px;
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .preview-thumb {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ffffff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
            <h4 class="fw-bold text-dark mb-1">Update Teacher Profile</h4>
            <p class="text-muted small mb-0">Modify professional deployment metrics and profiles</p>
        </div>
        <div>
            <a href="viewTeacher.php" class="btn btn-sm btn-outline-secondary px-3">
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
                
                <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row g-4">
                        
                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="teacherName">Teacher Name</label>
                            <input type="text" name="name" class="form-control form-input-clean" id="teacherName" 
                                   value="<?php echo htmlspecialchars($teacher['name']); ?>" required>
                            <div class="invalid-feedback">Faculty baseline name is required.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="teacherDescription">Description / Bio</label>
                            <textarea name="description" class="form-control form-input-clean" id="teacherDescription" rows="4" required><?php echo htmlspecialchars($teacher['description']); ?></textarea>
                            <div class="invalid-feedback">Please include an education context background.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label form-label-custom d-block">Current Profile Photo Asset</label>
                            <div class="preview-badge-box">
                                <?php 
                                $raw_img = trim($teacher['image']);
                                if(!empty($raw_img) && file_exists("./" . $raw_img) && !is_dir("./" . $raw_img)): 
                                ?>
                                    <img src="<?php echo htmlspecialchars($raw_img); ?>" class="preview-thumb" alt="Current Photo">
                                    <span class="small text-muted font-monospace text-truncate" style="max-width: 250px;">
                                        <?php echo htmlspecialchars(basename($raw_img)); ?>
                                    </span>
                                <?php else: ?>
                                    <div class="bg-secondary-subtle rounded-circle d-flex align-items-center justify-content-center" style="width:55px; height:55px;">
                                        <i class="bi bi-person text-secondary fs-4"></i>
                                    </div>
                                    <span class="small text-muted italic">No profile picture found on disk.</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label form-label-custom" for="teacherImage">Upload New Profile Image (Optional)</label>
                            <input type="file" name="image" class="form-control form-input-clean" id="teacherImage" accept="image/*">
                            <div class="form-text text-muted small mt-1">Leave this input field empty if you wish to retain the current picture.</div>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <div style="border-top: 1px solid #f1f5f9;"></div>
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                            <a href="viewTeacher.php" class="btn btn-light px-4 text-secondary border" style="font-size: 0.92rem;">Cancel Changes</a>
                            <button type="submit" name="update_teacher" class="btn btn-submit-clean px-4">
                                Save Profile Updates
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