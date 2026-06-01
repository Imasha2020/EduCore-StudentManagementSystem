<?php 
// 1. Include Global Structural Elements, Authentication & Role Checks
include 'header.php'; 

// 2. Process Delete Requests Safely Before Rendering the Page Architecture
$message_status = "";
$message_class = "";

if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($data, $_GET['delete_id']);
    
    // Fetch image path string first to purge the file resource asset from disk
    $select_file_query = "SELECT image FROM teacher WHERE id = '$delete_id'";
    $file_result = mysqli_query($data, $select_file_query);
    
    if ($file_result && mysqli_num_rows($file_result) > 0) {
        $file_row = mysqli_fetch_assoc($file_result);
        $file_path = "./" . $file_row['image'];
        
        // Remove the physical file if it exists on your storage directory
        if (file_exists($file_path) && !is_dir($file_path)) {
            unlink($file_path);
        }
    }

    // Execute absolute structural deletion entry from database
    $delete_query = "DELETE FROM teacher WHERE id = '$delete_id'";
    if (mysqli_query($data, $delete_query)) {
        $message_status = "Success: Teacher profile and associated image asset deleted successfully.";
        $message_class = "alert-success";
    } else {
        $message_status = "Database Error: Could not delete record. " . mysqli_error($data);
        $message_class = "alert-danger";
    }
}

// 3. Query all existing records out from the table
$select_query = "SELECT * FROM teacher ORDER BY id DESC";
$teachers_dataset = mysqli_query($data, $select_query);

// 4. Include Responsive Structural Topbar Architecture
include 'navbar.php'; 

// 5. Include Left Navigation Controller
include 'sidebar.php'; 
?>

<style>
    /* Minimal Dashboard Topbar */
    .page-title-box {
        padding-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    /* Professional Executive Profile Grid Card */
    .teacher-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .teacher-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        border-color: #cbd5e1;
    }

    /* Premium Circular Profile Image Configuration */
    .avatar-container {
        width: 110px;
        height: 110px;
        margin: 24px auto 12px;
        position: relative;
    }

    .avatar-frame {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.08), 0 2px 4px -1px rgba(0,0,0,0.04);
        background-color: #f1f5f9;
    }

    .avatar-fallback {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #2563eb;
        font-size: 2.2rem;
        border: 1px solid #bfdbfe;
    }

    .teacher-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.02em;
    }

    .teacher-desc {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.5;
        height: 68px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    /* Clean Uniform Micro Button Layouts */
    .btn-action-edit {
        background-color: #ffffff;
        color: #334155;
        border: 1px solid #dcdfe4;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 8px 14px;
        border-radius: 6px;
        transition: all 0.15s ease;
    }

    .btn-action-edit:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
    }

    .btn-action-delete {
        background-color: #ffffff;
        color: #ef4444;
        border: 1px solid #fca5a5;
        font-size: 0.82rem;
        font-weight: 500;
        padding: 8px 14px;
        border-radius: 6px;
        transition: all 0.15s ease;
    }

    .btn-action-delete:hover {
        background-color: #fef2f2;
        color: #dc2626;
        border-color: #f87171;
    }
</style>

<div class="col-md-9 ms-sm-auto col-lg-10 main-content">
    
    <div class="page-title-box d-flex justify-content-between align-items-center flex-wrap gap-2 mt-2 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">View Teachers</h4>
            <p class="text-muted small mb-0">Manage institutional faculty members and operations</p>
        </div>
        <div>
            <a href="addTeacher.php" class="btn btn-sm btn-primary px-3">
                <i class="bi bi-person-plus me-1"></i> Add New Teacher
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

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-5">
        
        <?php 
        if ($teachers_dataset && mysqli_num_rows($teachers_dataset) > 0):
            while($teacher = mysqli_fetch_assoc($teachers_dataset)): 
                // Clean and structure target check path variable
                $raw_img = trim($teacher['image']);
                $local_file_exists = (!empty($raw_img) && file_exists("./" . $raw_img) && !is_dir("./" . $raw_img));
        ?>
            <div class="col">
                <div class="teacher-card h-100 d-flex flex-column text-center px-3 pb-4">
                    
                    <div class="avatar-container">
                        <?php if($local_file_exists): ?>
                            <img src="<?php echo htmlspecialchars($raw_img); ?>" class="avatar-frame" alt="<?php echo htmlspecialchars($teacher['name']); ?>">
                        <?php else: ?>
                            <div class="avatar-fallback">
                                <i class="bi bi-person-workspace"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="d-flex flex-column flex-grow-1 mt-2">
                        <h5 class="teacher-title text-truncate mb-1" title="<?php echo htmlspecialchars($teacher['name']); ?>">
                            <?php echo htmlspecialchars($teacher['name']); ?>
                        </h5>
                        <div class="text-muted mb-3 small fw-medium">Faculty Member</div>
                        
                        <p class="teacher-desc px-2 mb-4">
                            <?php echo htmlspecialchars($teacher['description']); ?>
                        </p>
                        
                        <div class="d-flex gap-2 justify-content-center mt-auto pt-3 border-top">
                            <a href="update_teacher.php?id=<?php echo $teacher['id']; ?>" class="btn btn-action-edit flex-grow-1 text-decoration-none">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            <a href="viewTeacher.php?delete_id=<?php echo $teacher['id']; ?>" 
                               class="btn btn-action-delete flex-grow-1 text-decoration-none" 
                               onclick="return confirm('Are you sure you want to permanently delete this teacher profile and their image record?');">
                                <i class="bi bi-trash3 me-1"></i> Delete
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        <?php 
            endwhile; 
        else: 
        ?>
            <div class="col-12 w-100 mt-2">
                <div class="text-center p-5 bg-white border rounded-3">
                    <i class="bi bi-people text-muted display-3 mb-3 d-block"></i>
                    <h5 class="text-secondary fw-semibold">No Faculty Records Found</h5>
                    <p class="text-muted small">Get started by creating a brand new profile using the 'Add New Teacher' action portal.</p>
                </div>
            </div>
        <?php endif; ?>

    </div>

</div>

<?php 
include 'footer.php'; 
?>