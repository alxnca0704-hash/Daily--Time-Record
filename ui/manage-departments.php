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
                <select name="department_select">
                    <option value="new">-- Add New Department --</option>
                    <option value="1">Administrative</option>
                    <option value="2">Finance</option>
                    <option value="3">Operations</option>
                </select>
            </div>

            <div class="form-group">
                <label>Department Name</label>
                <input type="text" name="department_name" placeholder="Official Designation">
            </div>

            <div class="form-group">
                <label>Department Head</label>
                <input type="text" name="department_head" placeholder="Full Name & Designation">
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
                        <div class="custom-time-selection">
                            <select name="am_arrival_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==8 ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <select name="am_arrival_m" class="time-select">
                                <?php for($i=0; $i<=55; $i+=5) echo "<option value='".sprintf("%02d", $i)."'>".sprintf("%02d", $i)."</option>"; ?>
                            </select>
                            <select name="am_arrival_ap" class="time-select">
                                <option value="AM" selected>AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Departure</label>
                        <div class="custom-time-selection">
                            <select name="am_departure_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==12 ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <select name="am_departure_m" class="time-select">
                                <?php for($i=0; $i<=55; $i+=5) echo "<option value='".sprintf("%02d", $i)."'>".sprintf("%02d", $i)."</option>"; ?>
                            </select>
                            <select name="am_departure_ap" class="time-select">
                                <option value="AM" selected>AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
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
                        <div class="custom-time-selection">
                            <select name="pm_arrival_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==1 ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <select name="pm_arrival_m" class="time-select">
                                <?php for($i=0; $i<=55; $i+=5) echo "<option value='".sprintf("%02d", $i)."'>".sprintf("%02d", $i)."</option>"; ?>
                            </select>
                            <select name="pm_arrival_ap" class="time-select">
                                <option value="AM">AM</option>
                                <option value="PM" selected>PM</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Departure</label>
                        <div class="custom-time-selection">
                            <select name="pm_departure_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==5 ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <select name="pm_departure_m" class="time-select">
                                <?php for($i=0; $i<=55; $i+=5) echo "<option value='".sprintf("%02d", $i)."'>".sprintf("%02d", $i)."</option>"; ?>
                            </select>
                            <select name="pm_departure_ap" class="time-select">
                                <option value="AM">AM</option>
                                <option value="PM" selected>PM</option>
                            </select>
                        </div>
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
                <?php if (empty($_SESSION['departments'])): ?>
                    <tr>
                        <td colspan="4" style="padding: 3rem; text-align: center;">
                            <div style="opacity: 0.5; margin-bottom: 0.5rem;"><i class="ph-bold ph-buildings" style="font-size: 2rem;"></i></div>
                            <p class="muted">No departments configured.</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['departments'] as $dept): ?>
                        <tr>
                            <td style="font-weight: 700; color: var(--zinc-900);"><?php echo htmlspecialchars($dept['name']); ?></td>
                            <td style="font-size: 0.8125rem; font-weight: 500;"><?php echo htmlspecialchars($dept['head']); ?></td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                    <span class="badge" style="background: var(--primary-soft); color: var(--primary-hover);">
                                        AM: <?php echo $dept['am_arrival'] . " - " . $dept['am_departure']; ?>
                                    </span>
                                    <span class="badge" style="background: #eff6ff; color: #1d4ed8;">
                                        PM: <?php echo $dept['pm_arrival'] . " - " . $dept['pm_departure']; ?>
                                    </span>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                                    <a href="index.php?page=edit-department&id=<?php echo $dept['id']; ?>" class="btn btn-outline" style="padding: 0.4rem 0.75rem; font-size: 0.75rem;">
                                        <i class="ph-bold ph-pencil-simple"></i> Edit
                                    </a>
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

