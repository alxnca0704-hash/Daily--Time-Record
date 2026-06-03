<div class="card">
    <h2>Create Daily Time Record</h2>
    
    <form action="logic/process-dtr.php" method="POST" enctype="multipart/form-data">
        <div class="section-title">Report Options</div>
        <div class="form-group">
            <label>Generate For:</label>
            <select name="report_type" id="report_type">
                <option value="all">All Employees</option>
                <option value="individual">Individual</option>
                <option value="department">Per Department</option>
            </select>
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
</script>
