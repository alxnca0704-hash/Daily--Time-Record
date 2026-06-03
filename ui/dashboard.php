<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
            <h2><i class="ph-bold ph-house-line" style="margin-right: 8px; vertical-align: middle;"></i> Welcome to DTR System</h2>
            <p style="color: var(--text-muted); max-width: 65ch;">Select an option from the navigation menu to manage personnel, configure department schedules, or generate official Daily Time Records.</p>
        </div>
        <div style="background: #f0fdf4; color: #166534; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.75rem; font-weight: 700; border: 1px solid #bbf7d0;">
            <i class="ph-bold ph-check-circle"></i> SYSTEM ACTIVE
        </div>
    </div>
    
    <div class="grid" style="margin-top: 2rem;">
        <div class="card" style="border-top: 4px solid var(--primary-color);">
            <div style="display: flex; gap: 1rem;">
                <div style="background: #f3f4f6; width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="ph-bold ph-file-text"></i>
                </div>
                <div>
                    <h3>Create DTR</h3>
                    <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">Generate official reports and import biometric logs.</p>
                    <a href="index.php?page=create-dtr" class="btn btn-primary">Generate</a>
                </div>
            </div>
        </div>
        
        <div class="card" style="border-top: 4px solid #3b82f6;">
            <div style="display: flex; gap: 1rem;">
                <div style="background: #eff6ff; width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #3b82f6;">
                    <i class="ph-bold ph-users"></i>
                </div>
                <div>
                    <h3>Personnel</h3>
                    <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">Maintain employee profiles and employment types.</p>
                    <a href="index.php?page=manage-employees" class="btn btn-primary" style="background: #3b82f6;">Manage</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid">
    <div class="card" style="border-left: 4px solid #f59e0b;">
        <h3 style="display: flex; align-items: center; gap: 8px;">
            <i class="ph-bold ph-chart-pie-slice" style="color: #f59e0b;"></i> System Overview
        </h3>
        <table style="margin-top: 0.5rem;">
            <tr>
                <td style="display: flex; align-items: center; gap: 8px; border:none; padding: 0.75rem 0;">
                    <i class="ph-bold ph-user-list"></i> Total Employees
                </td>
                <td style="text-align: right; font-weight: 800; border:none;"><?php echo count($_SESSION['employees']); ?></td>
            </tr>
            <tr>
                <td style="display: flex; align-items: center; gap: 8px; border:none; padding: 0.75rem 0;">
                    <i class="ph-bold ph-buildings"></i> Departments
                </td>
                <td style="text-align: right; font-weight: 800; border:none;"><?php echo count($_SESSION['departments']); ?></td>
            </tr>
            <tr>
                <td style="display: flex; align-items: center; gap: 8px; border:none; padding: 0.75rem 0;">
                    <i class="ph-bold ph-clock-countdown"></i> Manual Adjustments
                </td>
                <td style="text-align: right; font-weight: 800; border:none;"><?php echo count($_SESSION['manual_logs']); ?></td>
            </tr>
        </table>
    </div>
    
    <div class="card" style="border-left: 4px solid #8b5cf6;">
        <h3 style="display: flex; align-items: center; gap: 8px;">
            <i class="ph-bold ph-lightning" style="color: #8b5cf6;"></i> Quick Tasks
        </h3>
        <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: 1rem;">
            <a href="index.php?page=manage-departments" class="btn" style="justify-content: flex-start; background: #f5f3ff; color: #5b21b6; border: 1px solid #ddd6fe;">
                <i class="ph-bold ph-gear" style="margin-right: 8px;"></i> Configure Schedules
            </a>
            <a href="index.php?page=create-dtr" class="btn" style="justify-content: flex-start; background: #fffbeb; color: #92400e; border: 1px solid #fef3c7;">
                <i class="ph-bold ph-upload-simple" style="margin-right: 8px;"></i> Import Biometric Data
            </a>
        </div>
    </div>
</div>
