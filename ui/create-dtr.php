<div class="card">
    <h2><i class="ph-bold ph-printer" style="margin-right: 8px;"></i> Create Daily Time Record</h2>
    
    <form action="logic/process-dtr.php" method="POST" enctype="multipart/form-data">
        <div class="section-title"><i class="ph-bold ph-magnifying-glass" style="margin-right: 8px;"></i> Report Options</div>
        <div class="grid">
            <div class="form-group">
                <label><i class="ph-bold ph-users-three" style="margin-right: 4px;"></i> Generate For:</label>
                <select name="report_type" id="report_type">
                    <option value="all">All Employees</option>
                    <option value="individual">Individual</option>
                    <option value="department">Per Department</option>
                </select>
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label><i class="ph-bold ph-calendar-blank" style="margin-right: 4px;"></i> Select Date Range:</label>
                <div id="date_range_container" class="inline-picker-container"></div>
                <input type="hidden" name="date_range" id="date_range" required>
            </div>
        </div>

        <div id="individual_option" class="form-group" style="display:none;">
            <label><i class="ph-bold ph-user" style="margin-right: 4px;"></i> Select Employee Name:</label>
            <input type="text" name="employee_name" placeholder="Search name...">
        </div>

        <div id="department_option" class="form-group" style="display:none;">
            <label><i class="ph-bold ph-buildings" style="margin-right: 4px;"></i> Select Department:</label>
            <select name="department_id">
                <option value="">-- Select Department --</option>
                <option value="1">Administrative</option>
                <option value="2">Finance</option>
                <option value="3">Operations</option>
            </select>
        </div>

        <div class="section-title"><i class="ph-bold ph-file-arrow-up" style="margin-right: 8px;"></i> Import Attendance Data</div>
        <div class="form-group">
            <label><i class="ph-bold ph-cloud-arrow-up" style="margin-right: 4px;"></i> Select Report File (CSV/Excel):</label>
            <input type="file" name="report_file" accept=".csv, .xlsx, .xls">
            <small style="display: block; margin-top: 5px; color: #6b7280;"><i class="ph-bold ph-info"></i> Flash drive data can be uploaded here.</small>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary"><i class="ph-bold ph-eye" style="margin-right: 8px;"></i> Process and Preview</button>
            <button type="button" class="btn btn-success"><i class="ph-bold ph-file-pdf" style="margin-right: 8px;"></i> Export to PDF</button>
        </div>
    </form>
</div>

<div class="card">
    <div style="border-left: 4px solid var(--success-color); padding-left: 1rem;">
        <h3><i class="ph-bold ph-clock-counter-clockwise" style="color: var(--success-color); margin-right: 8px;"></i> Manual Attendance Adjustment</h3>
        <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1.5rem;">Use this to manually add a missing clock-in or clock-out record for an employee.</p>
        
        <form action="logic/process-manual-log.php" method="POST">
            <div class="grid">
                <div class="form-group">
                    <label><i class="ph-bold ph-user-circle-plus" style="margin-right: 4px;"></i> Employee:</label>
                    <input type="text" name="adj_employee" placeholder="Search employee...">
                </div>
                
                <div class="form-group">
                    <label><i class="ph-bold ph-sign-in" style="margin-right: 4px;"></i> Log Type:</label>
                    <select name="log_type">
                        <option value="in">Clock In</option>
                        <option value="out">Clock Out</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="ph-bold ph-calendar-plus" style="margin-right: 4px;"></i> Select Date & Time:</label>
                    <div id="adjustment_datetime_container" class="inline-picker-container"></div>
                    <input type="hidden" name="adjustment_datetime" id="adjustment_datetime" required>
                </div>
            </div>
            
            <div style="margin-top: 1rem;">
                <button type="submit" class="btn btn-success"><i class="ph-bold ph-floppy-disk" style="margin-right: 8px;"></i> Save Manual Record</button>
            </div>
        </form>

        <div class="section-title"><i class="ph-bold ph-clock" style="margin-right: 8px;"></i> Recent Adjustments</div>
        <table>
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Type</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION['manual_logs'])): ?>
                    <tr>
                        <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 1rem;">No recent adjustments.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach (array_reverse($_SESSION['manual_logs']) as $log): ?>
                        <tr>
                            <td style="font-weight: 700;"><?php echo htmlspecialchars($log['employee']); ?></td>
                            <td><?php echo $log['type'] === 'in' ? 'Clock In' : 'Clock Out'; ?></td>
                            <td><?php echo htmlspecialchars($log['datetime']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

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
