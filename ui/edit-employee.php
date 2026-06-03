<?php
$id = $_GET['id'] ?? null;
$employee = null;

if ($id) {
    foreach ($_SESSION['employees'] as $emp) {
        if ($emp['id'] == $id) {
            $employee = $emp;
            break;
        }
    }
}

if (!$employee):
?>
<div class="card">
    <h2>Employee not found</h2>
    <p>The requested employee record could not be located.</p>
    <a href="index.php?page=manage-employees" class="btn btn-primary" style="margin-top: 1rem;">Back to List</a>
</div>
<?php else: ?>
<div class="card">
    <h2>Edit Employee</h2>
    
    <form action="logic/process-edit-employee.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
        
        <div class="section-title">Update Information for <?php echo htmlspecialchars($employee['name']); ?></div>
        
        <div class="grid">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>ID#:</label>
                <input type="text" name="id_num" value="<?php echo htmlspecialchars($employee['id_num']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Employee Number:</label>
                <input type="text" name="employee_num" value="<?php echo htmlspecialchars($employee['employee_num']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Employee Type:</label>
                <select name="employee_type">
                    <option value="Regular" <?php echo $employee['employee_type'] == 'Regular' ? 'selected' : ''; ?>>Regular</option>
                    <option value="Contractual" <?php echo $employee['employee_type'] == 'Contractual' ? 'selected' : ''; ?>>Contractual</option>
                    <option value="JO" <?php echo $employee['employee_type'] == 'JO' ? 'selected' : ''; ?>>Job Order</option>
                </select>
            </div>

            <div class="form-group">
                <label>Department:</label>
                <select name="department_id">
                    <option value="1" <?php echo $employee['department_id'] == '1' ? 'selected' : ''; ?>>Administrative</option>
                    <option value="2" <?php echo $employee['department_id'] == '2' ? 'selected' : ''; ?>>Finance</option>
                    <option value="3" <?php echo $employee['department_id'] == '3' ? 'selected' : ''; ?>>Operations</option>
                </select>
            </div>
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">Update Employee</button>
            <a href="index.php?page=manage-employees" class="btn btn-success">Cancel</a>
        </div>
    </form>
</div>
<?php endif; ?>
