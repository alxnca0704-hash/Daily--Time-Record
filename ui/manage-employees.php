<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="ph-bold ph-users-three"></i> Employee Management</h2>
            <p class="muted">Register and manage personnel profiles within the system.</p>
        </div>
    </div>
    
    <form action="logic/process-employee.php" method="POST">
        <div class="grid">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Last Name, First Name M.I." required>
            </div>
            
            <div class="form-group">
                <label>DTR ID#</label>
                <input type="text" name="id_num" placeholder="Machine / DTR ID" required>
            </div>
            
            <div class="form-group">
                <label>Official Employee Number</label>
                <input type="text" name="employee_num" placeholder="HR Employee #" required>
            </div>
            
            <div class="form-group">
                <label>Employment Type</label>
                <select name="employee_type">
                    <option value="Regular">Regular</option>
                    <option value="Contractual">Contractual</option>
                    <option value="JO">Job Order</option>
                </select>
            </div>

            <div class="form-group">
                <label>Assigned Department</label>
                <select name="department_id">
                    <option value="1">Administrative</option>
                    <option value="2">Finance</option>
                    <option value="3">Operations</option>
                    <option value="4">Technical Services</option>
                </select>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; margin-top: 1rem; border-top: 1px solid var(--border-soft); padding-top: 1.5rem;">
            <button type="submit" class="btn btn-emerald">
                <i class="ph-bold ph-user-plus"></i> Save Employee Profile
            </button>
            <button type="reset" class="btn btn-outline">Clear Form</button>
        </div>
    </form>
</div>

<div class="card">
    <h3><i class="ph-bold ph-list-bullets" style="color: var(--primary); margin-right: 8px;"></i> Personnel Registry</h3>
    <p class="muted" style="margin-bottom: 1.5rem;">Currently registered employees in the system.</p>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>ID#</th>
                    <th>Employment Type</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION['employees'])): ?>
                    <tr>
                        <td colspan="4" style="padding: 3rem; text-align: center;">
                            <div style="opacity: 0.5; margin-bottom: 0.5rem;"><i class="ph-bold ph-users" style="font-size: 2rem;"></i></div>
                            <p class="muted">No employees registered yet.</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['employees'] as $emp): ?>
                        <tr>
                            <td style="font-weight: 600; color: var(--zinc-900);"><?php echo htmlspecialchars($emp['name']); ?></td>
                            <td><span style="font-family: monospace; font-weight: 700; color: var(--zinc-500);"><?php echo htmlspecialchars($emp['id_num']); ?></span></td>
                            <td>
                                <span class="badge" style="background: var(--zinc-100); color: var(--zinc-600);">
                                    <?php echo htmlspecialchars($emp['employee_type']); ?>
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                                    <a href="index.php?page=edit-employee&id=<?php echo $emp['id']; ?>" class="btn btn-outline" style="padding: 0.4rem 0.75rem; font-size: 0.75rem;">
                                        <i class="ph-bold ph-pencil-simple"></i> Edit
                                    </a>
                                    <a href="logic/process-delete-employee.php?id=<?php echo $emp['id']; ?>" class="btn btn-outline" style="padding: 0.4rem 0.75rem; font-size: 0.75rem; color: var(--error);" onclick="return confirm('Are you sure you want to delete this employee?')">
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

