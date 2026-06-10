<?php
require_once 'logic/db.php';

$id = $_GET['id'] ?? null;
$dept = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM departments WHERE id = ?");
    $stmt->execute([$id]);
    $dept = $stmt->fetch();
}

if (!$dept):
?>
<div class="card">
    <h2>Department not found</h2>
    <p>The requested department record could not be located.</p>
    <a href="index.php?page=manage-departments" class="btn btn-primary" style="margin-top: 1rem;">Back to List</a>
</div>
<?php else: ?>
<div class="card">
    <h2>Edit Department</h2>
    
    <form action="logic/process-department.php" method="POST">
        <input type="hidden" name="department_id" value="<?php echo htmlspecialchars($dept['id']); ?>">
        
        <div class="section-title">General Information</div>
        <div class="form-group">
            <label>Department Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($dept['name'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label>Department Head:</label>
            <input type="text" name="head" value="<?php echo htmlspecialchars($dept['head'] ?? ''); ?>" required>
        </div>

        <div class="section-title">Update Official Time</div>
        
        <div class="grid">
            <div class="card" style="background: #f9f9f9;">
                <h4>AM Schedule</h4>
                <div class="time-grid" style="margin-top: 10px;">
                    <div class="form-group">
                        <label>Arrival:</label>
                        <input type="time" name="am_arrival" value="<?php echo substr($dept['am_arrival'] ?? '', 0, 5); ?>">
                    </div>
                    <div class="form-group">
                        <label>Departure:</label>
                        <input type="time" name="am_departure" value="<?php echo substr($dept['am_departure'] ?? '', 0, 5); ?>">
                    </div>
                </div>
            </div>

            <div class="card" style="background: #f9f9f9;">
                <h4>PM Schedule</h4>
                <div class="time-grid" style="margin-top: 10px;">
                    <div class="form-group">
                        <label>Arrival:</label>
                        <input type="time" name="pm_arrival" value="<?php echo substr($dept['pm_arrival'] ?? '', 0, 5); ?>">
                    </div>
                    <div class="form-group">
                        <label>Departure:</label>
                        <input type="time" name="pm_departure" value="<?php echo substr($dept['pm_departure'] ?? '', 0, 5); ?>">
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">Update Department</button>
            <a href="index.php?page=manage-departments" class="btn btn-success">Cancel</a>
        </div>
    </form>
</div>
<?php endif; ?>
