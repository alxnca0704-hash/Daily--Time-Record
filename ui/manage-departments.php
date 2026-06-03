<div class="card">
    <h2>Manage Department</h2>
    
    <form action="logic/process-department.php" method="POST">
        <div class="form-group">
            <label>Select Department:</label>
            <select name="department_select">
                <option value="new">-- Add New Department --</option>
                <option value="1">Administrative</option>
                <option value="2">Finance</option>
                <option value="3">Operations</option>
            </select>
        </div>

        <div class="form-group">
            <label>Department Name:</label>
            <input type="text" name="department_name" placeholder="Enter Department Name">
        </div>

        <div class="form-group">
            <label>Department Head:</label>
            <input type="text" name="department_head" placeholder="Name of Department Head">
        </div>

        <div class="section-title">Official Time (Arrival & Departure)</div>
        
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

<script>
// No Flatpickr needed for time selection anymore
</script>
