<?php 
// 1. Include Global Structural Elements, Authentication & Role Checks
include 'header.php'; 

// 2. Process Delete Action Request gracefully
$message_status = "";
$message_class = "";

if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($data, $_GET['delete_id']);
    
    // Safety check: Avoid deleting the primary admin account during testing
    if ($delete_id == 1) {
        $message_status = "Action Denied: The system primary core administrator cannot be removed.";
        $message_class = "alert-warning";
    } else {
        $delete_query = "DELETE FROM user WHERE id = '$delete_id' AND usertype = 'student'";
        if (mysqli_query($data, $delete_query)) {
            $message_status = "Success: Student record was dropped from the registry securely.";
            $message_class = "alert-success";
        } else {
            $message_status = "Database Error: Failed to execute removal routine -> " . mysqli_error($data);
            $message_class = "alert-danger";
        }
    }
}

// 3. Query All Student Records exclusively (Filtering out admins)
$sql = "SELECT * FROM user WHERE usertype = 'student' ORDER BY id DESC"; 
$result = mysqli_query($data, $sql);
$total_students = mysqli_num_rows($result);

// 4. Include Responsive Structural Topbar Architecture
include 'navbar.php'; 

// 5. Include Left Navigation Controller
include 'sidebar.php'; 
?>

<style>
    .registry-header {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid var(--card-border);
        border-radius: 16px;
    }
    
    .table-card {
        border: 1px solid var(--card-border);
        border-radius: 16px;
        background: #ffffff;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
    }

    .table-modern th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        padding: 16px 24px !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    .table-modern td {
        padding: 16px 24px !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #f8fafc;
    }

    .counter-badge {
        background: #eff6ff;
        color: var(--brand-primary);
        font-size: 0.85rem;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 30px;
        border: 1px solid #dbeafe;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .avatar-modern {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #f0f5ff 0%, #dbeafe 100%);
        color: #2563eb;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 0.95rem;
        border: 1px solid #bfdbfe;
    }

    .record-badge {
        font-size: 0.72rem;
        font-weight: 600;
        background-color: #f1f5f9;
        color: #64748b;
        padding: 3px 8px;
        border-radius: 6px;
    }

    /* Minimal Action Button styling */
    .btn-action {
        padding: 6px 12px;
        font-size: 0.82rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-action-edit {
        background-color: #f0f5ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
    }

    .btn-action-edit:hover {
        background-color: #2563eb;
        color: #ffffff;
    }

    .btn-action-delete {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
    }

    .btn-action-delete:hover {
        background-color: #dc2626;
        color: #ffffff;
    }
</style>

<div class="col-md-9 ms-sm-auto col-lg-10 main-content">
    
    <div class="registry-header shadow-sm p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="fw-bold tracking-tight text-dark mb-1">Student Registry</h2>
                <p class="text-muted small mb-0">Manage active user profiles, modify account structures, or revoke security credentials.</p>
            </div>
            <div>
                <div class="counter-badge shadow-sm">
                    <i class="bi bi-people-fill"></i> 
                    <span>Total Students: <strong class="text-dark"><?php echo $total_students; ?></strong></span>
                </div>
            </div>
        </div>
    </div>

    <?php if(!empty($message_status)): ?>
        <div class="alert <?php echo $message_class; ?> alert-dismissible fade show border-0 shadow-sm p-3 mb-4" role="alert">
            <span class="small fw-medium"><?php echo $message_status; ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-card mb-4">
        
        <?php if ($total_students > 0): ?>
            <div class="table-responsive">
                <table class="table table-modern align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 8%">ID</th>
                            <th scope="col" style="width: 27%">Student Identity</th>
                            <th scope="col" style="width: 25%">Email Address</th>
                            <th scope="col" style="width: 20%">Phone Parameter</th>
                            <th scope="col" style="width: 20%" class="text-end">Management Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): 
                            $initial = strtoupper(substr($row['username'], 0, 1));
                        ?>
                            <tr>
                                <td>
                                    <span class="record-badge">#ST-<?php echo $row['id']; ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-modern"><?php echo htmlspecialchars($initial); ?></div>
                                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($row['username']); ?></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-secondary small"><?php echo htmlspecialchars($row['email']); ?></span>
                                </td>
                                <td>
                                    <span class="text-secondary small"><?php echo htmlspecialchars($row['phone']); ?></span>
                                hand</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="update_student.php?id=<?php echo $row['id']; ?>" class="btn-action btn-action-edit" title="Modify Record Details">
                                            <i class="bi bi-pencil-square"></i> Update
                                        </a>
                                        <a href="view_students.php?delete_id=<?php echo $row['id']; ?>" 
                                           class="btn-action btn-action-delete" 
                                           onclick="return confirm('Security Warning: Are you certain you want to permanently delete user account: <?php echo htmlspecialchars($row['username']); ?>? This cannot be undone.');" 
                                           title="Drop Record Permanently">
                                            <i class="bi bi-trash3-fill"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5 my-4">
                <i class="bi bi-people text-muted fs-1 mb-2 d-block"></i>
                <h5 class="fw-bold text-dark mb-1">No Active Student Accounts Found</h5>
                <p class="text-muted small mb-0">Use the registration dashboard panel to provision new entries.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php 
// 6. Close Layout Framework & Terminate Scripts Element
include 'footer.php'; 
?>