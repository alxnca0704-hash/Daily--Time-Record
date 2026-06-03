<?php
$id = $_GET['id'] ?? null;
$dept = null;

if ($id) {
    foreach ($_SESSION['departments'] as $d) {
        if ($d['id'] == $id) {
            $dept = $d;
            break;
        }
    }
}

if (!$dept):
?>
<div class="card">
    <h2>Department not found</h2>
    <p>The requested department record could not be located.</p>
    <a href="index.php?page=manage-departments" class="btn btn-primary" style="margin-top: 1rem;">Back to List</a>
</div>
<?php else: 
    // Parse time strings back for select elements
    preg_match('/(\d+):(\d+) (\w+)/', $dept['am_arrival'], $am_arr);
    preg_match('/(\d+):(\d+) (\w+)/', $dept['am_departure'], $am_dep);
    preg_match('/(\d+):(\d+) (\w+)/', $dept['pm_arrival'], $pm_arr);
    preg_match('/(\d+):(\d+) (\w+)/', $dept['pm_departure'], $pm_dep);
?>
<div class="card">
    <h2>Edit Department</h2>
    
    <form action="logic/process-edit-department.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $dept['id']; ?>">
        
        <div class="section-title">General Information</div>
        <div class="form-group">
            <label>Department Name:</label>
            <input type="text" name="department_name" value="<?php echo htmlspecialchars($dept['name']); ?>" required>
        </div>

        <div class="form-group">
            <label>Department Head:</label>
            <input type="text" name="department_head" value="<?php echo htmlspecialchars($dept['head']); ?>" required>
        </div>

        <div class="section-title">Update Official Time</div>
        
        <div class="grid">
            <div class="card" style="background: #f9f9f9;">
                <h4>AM Schedule</h4>
                <div class="time-grid" style="margin-top: 10px;">
                    <div class="form-group">
                        <label>Arrival:</label>
                        <div class="custom-time-selection">
                            <select name="am_arrival_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==$am_arr[1] ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <span>:</span>
                            <select name="am_arrival_m" class="time-select">
                                <?php for($i=0; $i<=55; $i+=5) echo "<option value='".sprintf("%02d", $i)."' ".($i==$am_arr[2] ? "selected" : "").">".sprintf("%02d", $i)."</option>"; ?>
                            </select>
                            <select name="am_arrival_ap" class="time-select">
                                <option value="AM" <?php echo $am_arr[3] == 'AM' ? 'selected' : ''; ?>>AM</option>
                                <option value="PM" <?php echo $am_arr[3] == 'PM' ? 'selected' : ''; ?>>PM</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Departure:</label>
                        <div class="custom-time-selection">
                            <select name="am_departure_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==$am_dep[1] ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <span>:</span>
                            <select name="am_departure_m" class="time-select">
                                <?php for($i=0; $i<=55; $i+=5) echo "<option value='".sprintf("%02d", $i)."' ".($i==$am_dep[2] ? "selected" : "").">".sprintf("%02d", $i)."</option>"; ?>
                            </select>
                            <select name="am_departure_ap" class="time-select">
                                <option value="AM" <?php echo $am_dep[3] == 'AM' ? 'selected' : ''; ?>>AM</option>
                                <option value="PM" <?php echo $am_dep[3] == 'PM' ? 'selected' : ''; ?>>PM</option>
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
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==$pm_arr[1] ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <span>:</span>
                            <select name="pm_arrival_m" class="time-select">
                                <?php for($i=0; $i<=55; $i+=5) echo "<option value='".sprintf("%02d", $i)."' ".($i==$pm_arr[2] ? "selected" : "").">".sprintf("%02d", $i)."</option>"; ?>
                            </select>
                            <select name="pm_arrival_ap" class="time-select">
                                <option value="AM" <?php echo $pm_arr[3] == 'AM' ? 'selected' : ''; ?>>AM</option>
                                <option value="PM" <?php echo $pm_arr[3] == 'PM' ? 'selected' : ''; ?>>PM</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Departure:</label>
                        <div class="custom-time-selection">
                            <select name="pm_departure_h" class="time-select">
                                <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."' ".($i==$pm_dep[1] ? "selected" : "").">$i</option>"; ?>
                            </select>
                            <span>:</span>
                            <select name="pm_departure_m" class="time-select">
                                <?php for($i=0; $i<=55; $i+=5) echo "<option value='".sprintf("%02d", $i)."' ".($i==$pm_dep[2] ? "selected" : "").">".sprintf("%02d", $i)."</option>"; ?>
                            </select>
                            <select name="pm_departure_ap" class="time-select">
                                <option value="AM" <?php echo $pm_dep[3] == 'AM' ? 'selected' : ''; ?>>AM</option>
                                <option value="PM" <?php echo $pm_dep[3] == 'PM' ? 'selected' : ''; ?>>PM</option>
                            </select>
                        </div>
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
