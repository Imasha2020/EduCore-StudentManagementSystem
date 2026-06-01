<?php 
// 1. Include Global Structural Elements, Authentication & Role Checks
include 'header.php'; 

// 2. Process Delete Operational Submissions Safely
$message_status = "";
$message_class = "";

if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($data, $_GET['delete_id']);
    
    $delete_query = "DELETE FROM course WHERE id = '$delete_id'";
    if (mysqli_query($data, $delete_query)) {
        $message_status = "Success: Course structural catalog record removed successfully.";
        $message_class = "alert-success";
    } else {
        $message_status = "Database Error: Failed to drop entry. " . mysqli_error($data);
        $message_class = "alert-danger";
    }
}

// 3. Extract Curriculum Dataset
$select_query = "SELECT * FROM course ORDER BY course_code ASC";
$courses_dataset = mysqli_query($data, $select_query);

// 4. Include Layout Architecture
include 'navbar.php'; 
include 'sidebar.php'; 
?>

<style>
    .page-title-box {
        padding-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-container-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .custom-table th {
        background-color: #f8fafc;
        color: #334155;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        padding: 14px 16px;
        border-bottom: 1px solid #e2e8f0;
    }

    .custom-table td {
        padding: 14px 16px;
        font-size: 0.9rem;
        color: #0f172a;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .code-badge {
        background-color: #eff6ff;
        color: #2563eb;
        font-family: monospace;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 4px;
        border: 1px solid #dbeafe;
    }

    .btn-action-edit {
        background-color: #ffffff;
        color: #334155;
        border: 1px solid #cbd5e1;
        font-size: 0.82rem;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 4px;
        transition: all 0.15s ease;
    }

    .btn-action-edit:hover {
        background-color: #f8fafc;
        color: #0f172a;
    }

    .btn-action-delete {
        background-color: #ffffff;
        color: #ef4444;
        border: 1px solid #fca5a5;
        font-size: 0.82rem;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 4px;
        transition: all 0.15s ease;
    }

    .btn-action-delete:hover {
        background-color: #fef2f2;
        color: #dc2626;
    }
</style>

<div class="col-md-9 ms-sm-auto col-lg-10 main-content">
    
    <div class="page-title-box d-flex justify-content-between align-items-center flex-wrap gap-2 mt-2 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">View Courses</h4>
            <p class="text-muted small mb-0">Review, organize, and manage academic program catalogs</p>
        </div>
        <div>
            <a href="addCourse.php" class="btn btn-sm btn-primary px-3">
                <i class="bi bi-plus-circle me-1"></i> Add New Course
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

    <div class="table-container-card mb-5">
        <div class="table-responsive">
            <table class="table custom-table mb-0 table-hover">
                <thead>
                    <tr>
                        <th style="width: 15%;">Course Code</th>
                        <th style="width: 30%;">Course Title</th>
                        <th style="width: 15%;">Duration</th>
                        <th style="width: 25%;">Description Summary</th>
                        <th style="width: 15%; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($courses_dataset && mysqli_num_rows($courses_dataset) > 0):
                        while($course = mysqli_fetch_assoc($courses_dataset)): 
                    ?>
                        <tr>
                            <td>
                                <span class="code-badge"><?php echo htmlspecialchars($course['course_code']); ?></span>
                            </td>
                            <td class="fw-semibold text-dark">
                                <?php echo htmlspecialchars($course['course_name']); ?>
                            </td>
                            <td>
                                <span class="text-secondary"><i class="bi bi-clock me-1 small"></i> <?php echo htmlspecialchars($course['duration']); ?></span>
                            </td>
                            <td>
                                <div class="text-muted text-truncate" style="max-width: 260px;" title="<?php echo htmlspecialchars($course['description']); ?>">
                                    <?php echo htmlspecialchars($course['description']); ?>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <div class="d-inline-flex gap-1">
                                    <a href="updateCourse.php?id=<?php echo $course['id']; ?>" class="btn btn-action-edit text-decoration-none">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="viewCourses.php?delete_id=<?php echo $course['id']; ?>" 
                                       class="btn btn-action-delete text-decoration-none"
                                       onclick="return confirm('Are you sure you want to permanently drop this course item from catalogs?');">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                        <tr>
                            <td colspan="5" class="text-center p-5 bg-white">
                                <i class="bi bi-journal-x text-muted display-4 mb-3 d-block"></i>
                                <h6 class="text-secondary fw-semibold">No Courses Registered Yet</h6>
                                <p class="text-muted small mb-0">Use the primary portal command tools to construct structural syllabuses.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php 
include 'footer.php'; 
?>