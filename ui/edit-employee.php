<?php
require_once 'logic/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php?page=manage-employees");
    exit;
}

// Fetch employee data
$stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$employee = $stmt->fetch();

if (!$employee) {
    $_SESSION['flash'] = "Employee not found.";
    header("Location: index.php?page=manage-employees");
    exit;
}

// Fetch departments for the dropdown
$dept_stmt = $pdo->query("SELECT id, name FROM departments ORDER BY name ASC");
$departments = $dept_stmt->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="ph-bold ph-pencil-simple"></i> Edit Employee Profile</h2>
            <p class="muted">Update personnel information for <strong><?php echo htmlspecialchars($employee['name']); ?></strong>.</p>
        </div>
    </div>
    
    <form action="logic/process-edit-employee.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
        
        <div class="grid">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>DTR ID#</label>
                <input type="text" name="id_num" value="<?php echo htmlspecialchars($employee['id_num']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Official Employee Number</label>
                <input type="text" name="employee_num" value="<?php echo htmlspecialchars($employee['employee_num']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Employment Type</label>
                <select name="employee_type">
                    <option value="Regular" <?php echo $employee['employee_type'] == 'Regular' ? 'selected' : ''; ?>>Regular</option>
                    <option value="Contractual" <?php echo $employee['employee_type'] == 'Contractual' ? 'selected' : ''; ?>>Contractual</option>
                    <option value="JO" <?php echo $employee['employee_type'] == 'JO' ? 'selected' : ''; ?>>Job Order</option>
                </select>
            </div>

            <div class="form-group">
                <label>Assigned Department</label>
                <select name="department_id">
                    <option value="">-- Select Department --</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?php echo $dept['id']; ?>" <?php echo $employee['department_id'] == $dept['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($dept['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; margin-top: 1rem; border-top: 1px solid var(--border-soft); padding-top: 1.5rem;">
            <button type="submit" class="btn btn-emerald">
                <i class="ph-bold ph-floppy-disk"></i> Update Profile
            </button>
            <a href="index.php?page=manage-employees" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
