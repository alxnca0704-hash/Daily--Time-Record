<div class="card">
    <h2><i class="ph-bold ph-buildings" style="margin-right: 8px;"></i> Manage Department</h2>
    
    <form action="logic/process-department.php" method="POST">
        <div class="form-group">
            <label><i class="ph-bold ph-list-bullets" style="margin-right: 4px;"></i> Select Department:</label>
            <select name="department_select">
                <option value="new">-- Add New Department --</option>
                <option value="1">Administrative</option>
                <option value="2">Finance</option>
                <option value="3">Operations</option>
            </select>
        </div>

        <div class="form-group">
            <label><i class="ph-bold ph-tag" style="margin-right: 4px;"></i> Department Name:</label>
            <input type="text" name="department_name" placeholder="Enter Department Name">
        </div>

        <div class="form-group">
            <label><i class="ph-bold ph-user-focus" style="margin-right: 4px;"></i> Department Head:</label>
            <input type="text" name="department_head" placeholder="Name of Department Head">
        </div>

        <div class="section-title"><i class="ph-bold ph-clock" style="margin-right: 8px;"></i> Official Time (Arrival & Departure)</div>
        
        <div class="grid">
            <div class="card" style="background: #f9f9f9;">
                <h4>AM Schedule</h4>
                <div class="time-grid" style="margin-top: 10px;">
                    <div class="form-group">
                        <label>Arrival:</label>
                        <div class="custom-time-selection">
                            <select name="am_arrival_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==8 ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <span>:</span>
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
                        <label>Departure:</label>
                        <div class="custom-time-selection">
                            <select name="am_departure_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==12 ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <span>:</span>
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

            <div class="card" style="background: #f9f9f9;">
                <h4>PM Schedule</h4>
                <div class="time-grid" style="margin-top: 10px;">
                    <div class="form-group">
                        <label>Arrival:</label>
                        <div class="custom-time-selection">
                            <select name="pm_arrival_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==1 ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <span>:</span>
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
                        <label>Departure:</label>
                        <div class="custom-time-selection">
                            <select name="pm_departure_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==5 ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <span>:</span>
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

        <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">Save Department Settings</button>
        </div>
    </form>
</div>

<div class="card">
    <h3>Existing Departments</h3>
    <table>
        <thead>
            <tr>
                <th>Department Name</th>
                <th>Head</th>
                <th>AM Schedule</th>
                <th>PM Schedule</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($_SESSION['departments'])): ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-muted);">No departments configured.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($_SESSION['departments'] as $dept): ?>
                    <tr>
                        <td style="font-weight: 700;"><?php echo htmlspecialchars($dept['name']); ?></td>
                        <td><?php echo htmlspecialchars($dept['head']); ?></td>
                        <td><?php echo $dept['am_arrival'] . " - " . $dept['am_departure']; ?></td>
                        <td><?php echo $dept['pm_arrival'] . " - " . $dept['pm_departure']; ?></td>
                        <td>
                            <a href="index.php?page=edit-department&id=<?php echo $dept['id']; ?>" style="color: var(--primary-color); font-weight: 700; margin-right: 10px;">Edit</a>
                            <a href="logic/process-delete-department.php?id=<?php echo $dept['id']; ?>" style="color: var(--error-color); font-weight: 700;" onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
// No Flatpickr needed for time selection anymore
</script>
