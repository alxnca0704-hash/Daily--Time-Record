<div class="card">
    <h2><i class="ph-bold ph-user-plus" style="margin-right: 8px;"></i> Manage Employee</h2>
    
    <form action="logic/process-employee.php" method="POST">
        <div class="section-title"><i class="ph-bold ph-identification-card" style="margin-right: 8px;"></i> Add / Edit Employee</div>
        
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
            <?php if (empty($_SESSION['employees'])): ?>
                <tr>
                    <td colspan="4" style="padding: 20px; text-align: center; color: var(--text-muted);">No employees added yet.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($_SESSION['employees'] as $emp): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($emp['name']); ?></td>
                        <td><?php echo htmlspecialchars($emp['id_num']); ?></td>
                        <td><?php echo htmlspecialchars($emp['employee_type']); ?></td>
                        <td>
                            <a href="index.php?page=edit-employee&id=<?php echo $emp['id']; ?>" style="color: var(--primary-color); font-weight: 700; margin-right: 10px;">Edit</a>
                            <a href="logic/process-delete-employee.php?id=<?php echo $emp['id']; ?>" style="color: var(--error-color); font-weight: 700;" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
