<?php
require_once 'logic/db.php';

// Fetch departments for the dropdown
$dept_stmt = $pdo->query("SELECT id, name FROM departments ORDER BY name ASC");
$departments = $dept_stmt->fetchAll();

// Fetch recent manual logs
$log_stmt = $pdo->query("
    SELECT l.*, e.name as employee_name 
    FROM attendance_logs l 
    JOIN employees e ON l.employee_id = e.id 
    WHERE l.source = 'manual' 
    ORDER BY l.log_timestamp DESC 
    LIMIT 10
");
$recent_logs = $log_stmt->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="ph-bold ph-printer"></i> Generate DTR Report</h2>
            <p class="muted">Process attendance data and generate official Daily Time Records.</p>
        </div>
    </div>
    
    <form action="logic/process-dtr.php" method="POST" enctype="multipart/form-data">
        <h3 style="margin-bottom: 1.25rem;"><i class="ph-bold ph-magnifying-glass" style="color: var(--primary); margin-right: 8px;"></i> Report Configuration</h3>
        
        <div class="grid">
            <div class="form-group">
                <label>Generate For</label>
                <select name="report_type" id="report_type">
                    <option value="all">All Employees</option>
                    <option value="individual">Specific Individual</option>
                    <option value="department">Per Department Unit</option>
                </select>
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label>Target Date Range</label>
                <div id="date_range_container" class="inline-picker-container"></div>
                <input type="hidden" name="date_range" id="date_range" required>
            </div>
        </div>

        <div id="individual_option" class="form-group" style="display:none; margin-top: 1rem; animation: slideDown 0.3s ease;">
            <label>Employee Name or ID#</label>
            <input type="text" name="employee_name" placeholder="Type name or ID to filter...">
        </div>

        <div id="department_option" class="form-group" style="display:none; margin-top: 1rem; animation: slideDown 0.3s ease;">
            <label>Select Department Unit</label>
            <select name="department_id">
                <option value="">-- Choose Unit --</option>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?php echo $dept['id']; ?>"><?php echo htmlspecialchars($dept['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin: 2.5rem 0 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-soft);">
            <h3 style="margin-bottom: 1.25rem;"><i class="ph-bold ph-file-arrow-up" style="color: var(--info); margin-right: 8px;"></i> Data Integration</h3>
            <div class="form-group">
                <label>Attendance Log File (CSV / Excel)</label>
                <input type="file" name="report_file" accept=".csv, .xlsx, .xls">
                <p class="muted" style="font-size: 0.75rem; margin-top: 0.5rem;">
                    <i class="ph-bold ph-info"></i> Upload biometric machine exports or CSV logs here.
                </p>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-emerald" style="flex: 1;">
                <i class="ph-bold ph-eye"></i> Process & Preview Report
            </button>
            <button type="button" class="btn btn-outline">
                <i class="ph-bold ph-file-pdf"></i> Export to PDF
            </button>
        </div>
    </form>
</div>

<div class="card" style="border-left: 4px solid var(--warning);">
    <div class="card-header" style="margin-bottom: 1.5rem;">
        <div>
            <h3><i class="ph-bold ph-clock-counter-clockwise" style="color: var(--warning); margin-right: 8px;"></i> Attendance Adjustments</h3>
            <p class="muted">Manually insert missing clock-in or clock-out entries.</p>
        </div>
    </div>
    
    <form action="logic/process-manual-log.php" method="POST">
        <div class="grid">
            <div class="form-group">
                <label>Select Personnel</label>
                <input type="text" name="adj_employee" placeholder="Name or ID#" required>
            </div>
            
            <div class="form-group">
                <label>Entry Type</label>
                <select name="log_type">
                    <option value="in">Arrival (Clock In)</option>
                    <option value="out">Departure (Clock Out)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Adjustment Date & Time</label>
                <div id="adjustment_datetime_container" class="inline-picker-container"></div>
                <input type="hidden" name="adjustment_datetime" id="adjustment_datetime" required>
            </div>
        </div>
        
        <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-soft);">
            <button type="submit" class="btn btn-primary">
                <i class="ph-bold ph-plus"></i> Append Manual Record
            </button>
        </div>
    </form>

    <div style="margin-top: 3rem;">
        <h3 style="font-size: 1rem; margin-bottom: 1rem;"><i class="ph-bold ph-history" style="color: var(--zinc-400); margin-right: 8px;"></i> Recent Adjustments Log</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recent_logs)): ?>
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 2.5rem;">
                                <p class="muted">No manual adjustments on record.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($recent_logs as $log): ?>
                            <tr>
                                <td style="font-weight: 700; color: var(--zinc-900);"><?php echo htmlspecialchars($log['employee_name']); ?></td>
                                <td>
                                    <span class="badge" style="background: <?php echo $log['log_type'] === 'in' ? 'var(--primary-soft)' : '#fef3c7'; ?>; color: <?php echo $log['log_type'] === 'in' ? 'var(--primary-hover)' : '#92400e'; ?>;">
                                        <?php echo $log['log_type'] === 'in' ? 'Arrival' : 'Departure'; ?>
                                    </span>
                                </td>
                                <td style="font-family: monospace; font-weight: 500;"><?php echo date("M d, Y h:i A", strtotime($log['log_timestamp'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
document.getElementById('report_type').addEventListener('change', function() {
    const individual = document.getElementById('individual_option');
    const department = document.getElementById('department_option');
    
    individual.style.display = 'none';
    department.style.display = 'none';
    
    if (this.value === 'individual') {
        individual.style.display = 'block';
    } else if (this.value === 'department') {
        department.style.display = 'block';
    }
});

flatpickr("#date_range_container", {
    mode: "range",
    inline: true,
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr, instance) {
        document.getElementById('date_range').value = dateStr;
    }
});

flatpickr("#adjustment_datetime_container", {
    inline: true,
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    onChange: function(selectedDates, dateStr, instance) {
        document.getElementById('adjustment_datetime').value = dateStr;
    }
});
</script>

