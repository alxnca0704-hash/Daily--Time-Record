<div class="card">
    <h2>Create Daily Time Record</h2>
    
    <form action="logic/process-dtr.php" method="POST" enctype="multipart/form-data">
        <div class="section-title">Report Options</div>
        <div class="grid">
            <div class="form-group">
                <label>Generate For:</label>
                <select name="report_type" id="report_type">
                    <option value="all">All Employees</option>
                    <option value="individual">Individual</option>
                    <option value="department">Per Department</option>
                </select>
            </div>

            <div class="form-group">
                <label>Date Range:</label>
                <input type="text" name="date_range" id="date_range" placeholder="Select Date Range..." required>
            </div>
        </div>

        <div id="individual_option" class="form-group" style="display:none;">
            <label>Select Employee Name:</label>
            <input type="text" name="employee_name" placeholder="Search name...">
        </div>

        <div id="department_option" class="form-group" style="display:none;">
            <label>Select Department:</label>
            <select name="department_id">
                <option value="">-- Select Department --</option>
                <option value="1">Administrative</option>
                <option value="2">Finance</option>
                <option value="3">Operations</option>
            </select>
        </div>

        <div class="section-title">Import Attendance Data</div>
        <div class="form-group">
            <label>Select Report File (CSV/Excel):</label>
            <input type="file" name="report_file" accept=".csv, .xlsx, .xls">
            <small style="display: block; margin-top: 5px; color: #666;">Flash drive data can be uploaded here.</small>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Process and Preview</button>
            <button type="button" class="btn btn-success">Export to PDF</button>
        </div>
    </form>
</div>

<div class="card">
    <div style="border-left: 4px solid var(--success-color); padding-left: 1rem;">
        <h3>Manual Attendance Adjustment</h3>
        <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1.5rem;">Use this to manually add a missing clock-in or clock-out record for an employee.</p>
        
        <form action="logic/process-manual-log.php" method="POST">
            <div class="grid">
                <div class="form-group">
                    <label>Employee:</label>
                    <input type="text" name="adj_employee" placeholder="Search employee...">
                </div>
                
                <div class="form-group">
                    <label>Log Type:</label>
                    <select name="log_type">
                        <option value="in">Clock In</option>
                        <option value="out">Clock Out</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Date & Time:</label>
                    <div id="adjustment_datetime_container" class="inline-picker-container"></div>
                    <input type="hidden" name="adjustment_datetime" id="adjustment_datetime" required>
                </div>
            </div>
            
            <div style="margin-top: 1rem;">
                <button type="submit" class="btn btn-success">Save Manual Record</button>
            </div>
        </form>
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

flatpickr("#date_range", {
    mode: "range",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "F j, Y"
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
