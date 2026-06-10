<?php
require_once 'logic/db.php';

// Fetch all departments
$stmt = $pdo->query("SELECT * FROM departments ORDER BY name ASC");
$departments = $stmt->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="ph-bold ph-buildings"></i> Department Configuration</h2>
            <p class="muted">Set official schedules and department leadership.</p>
        </div>
    </div>
    
    <form action="logic/process-department.php" method="POST">
        <div class="grid" style="margin-bottom: 2rem;">
            <div class="form-group">
                <label>Target Department</label>
                <select name="department_id" id="department_id">
                    <option value="new">-- Add New Department --</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?php echo htmlspecialchars($dept['id']); ?>"><?php echo htmlspecialchars($dept['name'] ?? ''); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Department Name</label>
                <input type="text" name="name" id="dept_name" placeholder="Official Designation" required>
            </div>

            <div class="form-group">
                <label>Department Head</label>
                <input type="text" name="head" id="dept_head" placeholder="Full Name & Designation">
            </div>
        </div>

        <h3 style="margin-bottom: 1.25rem;"><i class="ph-bold ph-clock" style="color: var(--primary); margin-right: 8px;"></i> Official Working Hours</h3>
        
        <div class="grid">
            <div class="stat-card" style="border-left: 4px solid var(--primary); background: var(--zinc-50);">
                <div style="font-weight: 700; color: var(--zinc-900); margin-bottom: 1rem; display: flex; align-items: center; gap: 8px;">
                    <i class="ph-bold ph-sun"></i> AM Schedule
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>Arrival</label>
                        <input type="time" name="am_arrival" id="am_arrival" value="08:00">
                    </div>
                    <div class="form-group">
                        <label>Departure</label>
                        <input type="time" name="am_departure" id="am_departure" value="12:00">
                    </div>
                </div>
            </div>

            <div class="stat-card" style="border-left: 4px solid var(--info); background: var(--zinc-50);">
                <div style="font-weight: 700; color: var(--zinc-900); margin-bottom: 1rem; display: flex; align-items: center; gap: 8px;">
                    <i class="ph-bold ph-moon"></i> PM Schedule
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>Arrival</label>
                        <input type="time" name="pm_arrival" id="pm_arrival" value="13:00">
                    </div>
                    <div class="form-group">
                        <label>Departure</label>
                        <input type="time" name="pm_departure" id="pm_departure" value="17:00">
                    </div>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; margin-top: 1rem; border-top: 1px solid var(--border-soft); padding-top: 1.5rem;">
            <button type="submit" class="btn btn-emerald">
                <i class="ph-bold ph-floppy-disk"></i> Save Department Settings
            </button>
        </div>
    </form>
</div>

<div class="card">
    <h3><i class="ph-bold ph-list-bullets" style="color: var(--primary); margin-right: 8px;"></i> Active Departments</h3>
    <p class="muted" style="margin-bottom: 1.5rem;">Current organizational units and their schedules.</p>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Head</th>
                    <th>Schedules (AM / PM)</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($departments)): ?>
                    <tr>
                        <td colspan="4" style="padding: 3rem; text-align: center;">
                            <div style="opacity: 0.5; margin-bottom: 0.5rem;"><i class="ph-bold ph-buildings" style="font-size: 2rem;"></i></div>
                            <p class="muted">No departments configured.</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($departments as $dept): ?>
                        <tr>
                            <td style="font-weight: 700; color: var(--zinc-900);"><?php echo htmlspecialchars($dept['name']); ?></td>
                            <td style="font-size: 0.8125rem; font-weight: 500;"><?php echo htmlspecialchars($dept['head']); ?></td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                    <span class="badge" style="background: var(--primary-soft); color: var(--primary-hover);">
                                        AM: <?php echo date("h:i A", strtotime($dept['am_arrival'])) . " - " . date("h:i A", strtotime($dept['am_departure'])); ?>
                                    </span>
                                    <span class="badge" style="background: #eff6ff; color: #1d4ed8;">
                                        PM: <?php echo date("h:i A", strtotime($dept['pm_arrival'])) . " - " . date("h:i A", strtotime($dept['pm_departure'])); ?>
                                    </span>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                                    <button type="button" class="btn btn-outline edit-dept-btn" 
                                            data-dept='<?php echo json_encode($dept); ?>'
                                            style="padding: 0.4rem 0.75rem; font-size: 0.75rem;">
                                        <i class="ph-bold ph-pencil-simple"></i> Edit
                                    </button>
                                    <a href="logic/process-delete-department.php?id=<?php echo $dept['id']; ?>" class="btn btn-outline" style="padding: 0.4rem 0.75rem; font-size: 0.75rem; color: var(--error);" onclick="return confirm('Are you sure you want to delete this department?')">
                                        <i class="ph-bold ph-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.querySelectorAll('.edit-dept-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const dept = JSON.parse(this.getAttribute('data-dept'));
        document.getElementById('department_id').value = dept.id;
        document.getElementById('dept_name').value = dept.name || '';
        document.getElementById('dept_head').value = dept.head || '';
        document.getElementById('am_arrival').value = (dept.am_arrival || '').substring(0, 5);
        document.getElementById('am_departure').value = (dept.am_departure || '').substring(0, 5);
        document.getElementById('pm_arrival').value = (dept.pm_arrival || '').substring(0, 5);
        document.getElementById('pm_departure').value = (dept.pm_departure || '').substring(0, 5);
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
</script>
