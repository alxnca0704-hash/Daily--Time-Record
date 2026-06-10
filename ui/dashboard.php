<?php
require_once 'logic/db.php';

// Fetch counts
$emp_count = $pdo->query("SELECT COUNT(*) FROM employees")->fetchColumn();
$dept_count = $pdo->query("SELECT COUNT(*) FROM departments")->fetchColumn();
$log_count = $pdo->query("SELECT COUNT(*) FROM attendance_logs WHERE source = 'manual' AND log_timestamp >= CURDATE() AND log_timestamp < CURDATE() + INTERVAL 1 DAY")->fetchColumn();

// Check DB connection status (already connected via db.php)
$db_status = "Connected";
$db_badge_style = "background: var(--primary-soft); color: var(--primary-hover);";
?>

<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="ph-bold ph-house-line"></i> Welcome to DTR System</h2>
            <p class="muted">Manage personnel, configure department schedules, and generate official Daily Time Records for DENR.</p>
        </div>
        <div class="badge badge-success">
            <i class="ph-bold ph-check-circle" style="margin-right: 6px;"></i> System Active
        </div>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card" style="border-top: 3px solid var(--primary);">
            <span class="stat-label">Total Employees</span>
            <span class="stat-value"><?php echo $emp_count; ?></span>
            <div style="margin-top: auto; padding-top: 1rem;">
                <a href="index.php?page=manage-employees" class="btn btn-outline" style="width: 100%;">View All</a>
            </div>
        </div>
        
        <div class="stat-card" style="border-top: 3px solid var(--info);">
            <span class="stat-label">Active Departments</span>
            <span class="stat-value"><?php echo $dept_count; ?></span>
            <div style="margin-top: auto; padding-top: 1rem;">
                <a href="index.php?page=manage-departments" class="btn btn-outline" style="width: 100%;">Configure</a>
            </div>
        </div>

        <div class="stat-card" style="border-top: 3px solid var(--warning);">
            <span class="stat-label">Adjustment Logs</span>
            <span class="stat-value"><?php echo $log_count; ?></span>
            <div style="margin-top: auto; padding-top: 1rem;">
                <a href="index.php?page=create-dtr" class="btn btn-outline" style="width: 100%;">Review</a>
            </div>
        </div>
    </div>
</div>

<div class="grid">
    <div class="card">
        <h3><i class="ph-bold ph-lightning" style="color: var(--warning); margin-right: 8px;"></i> Quick Actions</h3>
        <p class="muted" style="margin-bottom: 1.5rem;">Commonly used administrative tasks.</p>
        
        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
            <a href="index.php?page=create-dtr" class="btn btn-emerald" style="justify-content: flex-start; padding: 1rem;">
                <i class="ph-bold ph-file-text"></i> Generate New DTR Report
            </a>
            <a href="index.php?page=manage-employees" class="btn btn-outline" style="justify-content: flex-start; padding: 1rem;">
                <i class="ph-bold ph-user-plus"></i> Add New Employee Profile
            </a>
        </div>
    </div>
    
    <div class="card">
        <h3><i class="ph-bold ph-info" style="color: var(--info); margin-right: 8px;"></i> System Information</h3>
        <p class="muted" style="margin-bottom: 1.5rem;">Current environment and versioning.</p>
        
        <div class="table-container">
            <table>
                <tr>
                    <td style="font-weight: 600;">Environment</td>
                    <td style="text-align: right;">Prototype / Local</td>
                </tr>
                <tr>
                    <td style="font-weight: 600;">Last Data Sync</td>
                    <td style="text-align: right;"><?php echo date('M d, Y H:i'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;">Database Status</td>
                    <td style="text-align: right;"><span class="badge" style="<?php echo $db_badge_style; ?>"><?php echo $db_status; ?></span></td>
                </tr>
            </table>
        </div>
    </div>
</div>

