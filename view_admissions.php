<?php 
// 1. Include Global Structural Elements, Authentication & Role Checks
include 'header.php'; 

// 2. Query Admissions Data (Uses database connection context defined in header.php)
$sql = "SELECT * FROM admission ORDER BY id DESC"; 
$result = mysqli_query($data, $sql);
$total_applications = mysqli_num_rows($result);

// 3. Include Responsive Structural Topbar Architecture
include 'navbar.php'; 

// 4. Include Left Navigation Controller
include 'sidebar.php'; 
?>

<!-- Extra Page-Specific Professional Style Adjustments -->
<style>
    /* Modern Dashboard Enhancements */
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
        padding: 18px 24px !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    .table-modern td {
        padding: 20px 24px !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Refined Badges & Decorative Components */
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

    .avatar-wrapper {
        position: relative;
    }

    .avatar-modern {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: var(--brand-primary);
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1rem;
        border: 1px solid #bfdbfe;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.05);
    }

    .record-badge {
        font-size: 0.72rem;
        font-weight: 600;
        background-color: #f1f5f9;
        color: #64748b;
        padding: 3px 8px;
        border-radius: 6px;
        display: inline-block;
        margin-top: 4px;
    }

    .contact-link {
        font-size: 0.88rem;
        color: #334155;
        text-decoration: none;
        transition: color 0.15s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .contact-link:hover {
        color: var(--brand-primary);
    }

    .message-modern-box {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 14px 16px;
        font-size: 0.85rem;
        color: #475569;
        max-height: 110px;
        overflow-y: auto;
        line-height: 1.6;
    }

    /* Slick Micro-Interactions on Action Pills */
    .pill-action-btn {
        padding: 8px 16px;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .btn-action-email { background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .btn-action-email:hover { background-color: #166534; color: #ffffff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(22, 101, 52, 0.15); }
    
    .btn-action-phone { background-color: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd; }
    .btn-action-phone:hover { background-color: #0369a1; color: #ffffff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(3, 105, 161, 0.15); }
</style>

<!-- Main Workspace Viewport Area -->
<div class="col-md-9 ms-sm-auto col-lg-10 main-content">
    
    <!-- Header Block -->
    <div class="registry-header shadow-sm p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="fw-bold tracking-tight text-dark mb-1">Admission Registries</h2>
                <p class="text-muted small mb-0">Review, manage, and process inbound student pipeline applications.</p>
            </div>
            <div>
                <div class="counter-badge shadow-sm">
                    <i class="bi bi-inboxes-fill text-primary"></i> 
                    <span>Pending Inbound: <strong class="text-dark"><?php echo $total_applications; ?></strong></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Presentation Container -->
    <div class="table-card mb-4">
        
        <?php if ($total_applications > 0): ?>
            <div class="table-responsive">
                <table class="table table-modern align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 28%">Applicant Details</th>
                            <th scope="col" style="width: 27%">Contact Parameters</th>
                            <th scope="col" style="width: 30%">Statement / Message</th>
                            <th scope="col" style="width: 15%" class="text-end">Action Interface</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): 
                            
                            // Single Character Initials Generation Logic
                            if (isset($row['name']) && !is_array($row['name']) && trim((string)$row['name']) !== '') {
                                $cleanString = trim((string)$row['name']);
                                $initials = strtoupper(substr($cleanString, 0, 1));
                            } else {
                                $initials = 'A';
                            }
                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-wrapper">
                                            <div class="avatar-modern">
                                                <?php echo htmlspecialchars($initials); ?>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark mb-0 fs-6">
                                                <?php echo is_array($row['name']) ? 'Applicant' : htmlspecialchars($row['name']); ?>
                                            </div>
                                            <span class="record-badge">#AD-<?php echo $row['id']; ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-2">
                                        <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" class="contact-link">
                                            <i class="bi bi-envelope text-muted me-2 fs-6"></i><?php echo htmlspecialchars($row['email']); ?>
                                        </a>
                                        <a href="tel:<?php echo htmlspecialchars($row['phone']); ?>" class="contact-link">
                                            <i class="bi bi-telephone text-muted me-2 fs-6"></i><?php echo htmlspecialchars($row['phone']); ?>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="message-modern-box">
                                        <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" class="pill-action-btn btn-action-email" title="Open Mail Client">
                                            <i class="bi bi-reply-fill"></i> Email
                                        </a>
                                        <a href="tel:<?php echo htmlspecialchars($row['phone']); ?>" class="pill-action-btn btn-action-phone" title="Initialize Call Link">
                                            <i class="bi bi-telephone-outbound"></i> Call
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <!-- Fallback Content State -->
            <div class="text-center py-5 my-5">
                <div class="p-3 bg-blue-subtle rounded-circle d-inline-block mb-3">
                    <i class="bi bi-folder-x fs-1 text-primary"></i>
                </div>
                <h4 class="fw-bold text-dark mb-2">No Inbound Pipelines Found</h4>
                <p class="text-muted small mb-0 mx-auto" style="max-width: 400px; font-size: 0.95rem;">
                    Currently, there are no structural data records appearing inside the admission registry table architecture.
                </p>
            </div>
        <?php endif; ?>

    </div>

</div>

<?php 
// 5. Close Layout Framework & Terminate Scripts Element
include 'footer.php'; 
?>