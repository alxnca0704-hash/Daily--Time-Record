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
                        <input type="time" name="am_arrival" value="08:00">
                    </div>
                    <div class="form-group">
                        <label>Departure:</label>
                        <input type="time" name="am_departure" value="12:00">
                    </div>
                </div>
            </div>

            <div class="card" style="background: #f9f9f9;">
                <h4>PM Schedule</h4>
                <div class="time-grid" style="margin-top: 10px;">
                    <div class="form-group">
                        <label>Arrival:</label>
                        <input type="time" name="pm_arrival" value="13:00">
                    </div>
                    <div class="form-group">
                        <label>Departure:</label>
                        <input type="time" name="pm_departure" value="17:00">
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">Save Department Settings</button>
        </div>
    </form>
</div>
