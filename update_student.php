<?php 
// 1. Include Global Structural Elements
include 'header.php'; 

$message_status = "";
$message_class = "";

// 2. Verify target input parameters exist safely
if (isset($_GET['id'])) {
    $student_id = mysqli_real_escape_string($data, $_GET['id']);
    
    // 3. Handle Form Update Commit Post Requests
    if (isset($_POST['update_student'])) {
        $username = mysqli_real_escape_string($data, trim($_POST['username']));
        $email    = mysqli_real_escape_string($data, trim($_POST['email']));
        $phone    = mysqli_real_escape_string($data, trim($_POST['phone']));
        
        $update_query = "UPDATE user SET username='$username', email='$email', phone='$phone' WHERE id='$student_id' AND usertype='student'";
        
        if (mysqli_query($data, $update_query)) {
            $message_status = "Success: Student account has been updated safely.";
            $message_class = "alert-success";
        } else {
            $message_status = "Error updating database context: " . mysqli_error($data);
            $message_class = "alert-danger";
        }
    }
    
    // 4. Fetch existing data properties to populate input scopes
    $fetch_query = "SELECT * FROM user WHERE id='$student_id' AND usertype='student'";
    $fetch_result = mysqli_query($data, $fetch_query);
    $current_data = mysqli_fetch_assoc($fetch_result);
    
    if (!$current_data) {
        header("Location: view_students.php");
        exit();
    }
} else {
    header("Location: view_students.php");
    exit();
}

include 'navbar.php'; 
include 'sidebar.php'; 
?>

<style>
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
    }
    .form-input-clean:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }
</style>

<div class="col-md-9 ms-sm-auto col-lg-10 main-content">
    
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mt-2 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Modify Profile Record</h4>
            <p class="text-muted small mb-0">Altering account fields for database index: <strong>#ST-<?php echo $student_id; ?></strong></p>
        </div>
        <a href="view_students.php" class="btn btn-sm btn-outline-secondary px-3">Cancel</a>
    </div>

    <?php if(!empty($message_status)): ?>
        <div class="alert <?php echo $message_class; ?> alert-dismissible fade show border-0 rounded-2 p-3 mb-4" role="alert">
            <span class="small fw-medium"><?php echo $message_status; ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xl-8 col-lg-10">
            <div class="form-container-card p-4 p-md-5 mb-5">
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label form-label-custom">Username</label>
                            <input type="text" name="username" class="form-control form-input-clean" value="<?php echo htmlspecialchars($current_data['username']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label form-label-custom">Email Address</label>
                            <input type="email" name="email" class="form-control form-input-clean" value="<?php echo htmlspecialchars($current_data['email']); ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label form-label-custom">Phone Number</label>
                            <input type="text" name="phone" class="form-control form-input-clean" value="<?php echo htmlspecialchars($current_data['phone']); ?>" required>
                        </div>
                        <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                            <a href="view_students.php" class="btn btn-light border px-4">Exit Workspace</a>
                            <button type="submit" name="update_student" class="btn btn-primary px-4" style="background-color: #2563eb; border-color: #2563eb;">Commit Changes</button>
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

<?php include 'footer.php'; ?>