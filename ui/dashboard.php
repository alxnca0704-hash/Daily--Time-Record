<div class="card">
    <h2>Welcome to the DTR System</h2>
    <p style="color: var(--text-muted); max-width: 65ch;">Select an option from the navigation menu to manage personnel, configure department schedules, or generate official Daily Time Records.</p>
    
    <div class="grid" style="margin-top: 2rem;">
        <div class="card">
            <div style="border-left: 4px solid var(--accent-color); padding-left: 1rem;">
                <h3>Create DTR</h3>
                <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">Generate official reports for individuals, departments, or all employees. Supports CSV/Excel log imports.</p>
                <a href="index.php?page=create-dtr" class="btn btn-primary">Generate Reports</a>
            </div>
        </div>
        
        <div class="card">
            <div style="border-left: 4px solid var(--success-color); padding-left: 1rem;">
                <h3>Manage Employees</h3>
                <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem;">Maintain employee profiles, including ID numbers and employment types (Regular, Contractual, JO).</p>
                <a href="index.php?page=manage-employees" class="btn btn-success">View Personnel</a>
            </div>
        </div>
    </div>
</div>

<div class="grid">
    <div class="card">
        <h3>System Overview</h3>
        <table style="margin-top: 0;">
            <tr>
                <td>Total Employees</td>
                <td style="text-align: right; font-weight: 600;">--</td>
            </tr>
            <tr>
                <td>Departments</td>
                <td style="text-align: right; font-weight: 600;">--</td>
            </tr>
            <tr>
                <td>Pending DTRs</td>
                <td style="text-align: right; font-weight: 600;">--</td>
            </tr>
        </table>
    </div>
    
    <div class="card">
        <h3>Quick Instructions</h3>
        <ul style="font-size: 0.875rem; color: var(--text-muted); padding-left: 1.25rem; line-height: 1.8;">
            <li>Ensure all departments have official schedules set.</li>
            <li>Import biometric data in CSV format for automated processing.</li>
            <li>Review individual DTRs before exporting to official PDF format.</li>
        </ul>
    </div>
</div>
