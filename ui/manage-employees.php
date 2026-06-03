<div class="card">
    <h2>Manage Employee</h2>
    
    <form action="logic/process-employee.php" method="POST">
        <div class="section-title">Add / Edit Employee</div>
        
        <div class="grid">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" placeholder="Last Name, First Name M.I." required>
            </div>
            
            <div class="form-group">
                <label>ID#:</label>
                <input type="text" name="id_num" placeholder="DTR ID" required>
            </div>
            
            <div class="form-group">
                <label>Employee Number:</label>
                <input type="text" name="employee_num" placeholder="Official Employee #" required>
            </div>
            
            <div class="form-group">
                <label>Employee Type:</label>
                <select name="employee_type">
                    <option value="Regular">Regular</option>
                    <option value="Contractual">Contractual</option>
                    <option value="JO">Job Order</option>
                </select>
            </div>

            <div class="form-group">
                <label>Department:</label>
                <select name="department_id">
                    <option value="1">Administrative</option>
                    <option value="2">Finance</option>
                    <option value="3">Operations</option>
                </select>
            </div>
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">Save Employee</button>
            <button type="reset" class="btn" style="background: #ccc;">Clear</button>
        </div>
    </form>
</div>

<div class="card">
    <h3>Existing Employees</h3>
    <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
        <thead>
            <tr style="background: var(--bg-color); text-align: left;">
                <th style="padding: 10px; border: 1px solid var(--border-color);">Name</th>
                <th style="padding: 10px; border: 1px solid var(--border-color);">ID#</th>
                <th style="padding: 10px; border: 1px solid var(--border-color);">Type</th>
                <th style="padding: 10px; border: 1px solid var(--border-color);">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 10px; border: 1px solid var(--border-color);">Doe, John</td>
                <td style="padding: 10px; border: 1px solid var(--border-color);">101</td>
                <td style="padding: 10px; border: 1px solid var(--border-color);">Regular</td>
                <td style="padding: 10px; border: 1px solid var(--border-color);">
                    <a href="#" style="color: var(--accent-color);">Edit</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
