<?php
require_once 'logic/db.php';

$type = $_GET['type'] ?? 'all';
$range = $_GET['range'] ?? '';
$emp_query = $_GET['emp'] ?? '';
$dept_id = $_GET['dept'] ?? '';

// Parse Date Range
$start_date = '';
$end_date = '';
if ($range) {
    if (strpos($range, ' to ') !== false) {
        list($start_date, $end_date) = explode(' to ', $range);
    } else {
        $start_date = $end_date = $range;
    }
}

// Build Employee Query
$query_parts = ["1=1"];
$params = [];

if ($type === 'individual' && $emp_query) {
    $query_parts[] = "(e.name LIKE ? OR e.id_num = ?)";
    $params[] = "%$emp_query%";
    $params[] = $emp_query;
} elseif ($type === 'department' && $dept_id) {
    $query_parts[] = "e.department_id = ?";
    $params[] = $dept_id;
}

$where_clause = implode(" AND ", $query_parts);

// Fetch Employees matching filters
$emp_stmt = $pdo->prepare("
    SELECT e.*, d.name as department_name, d.am_arrival, d.am_departure, d.pm_arrival, d.pm_departure
    FROM employees e
    LEFT JOIN departments d ON e.department_id = d.id
    WHERE $where_clause
    ORDER BY e.name ASC
");
$emp_stmt->execute($params);
$employees = $emp_stmt->fetchAll();

// Prepare DTR Data Structure
$dtr_data = [];

foreach ($employees as $employee) {
    $emp_id = $employee['id'];
    
    // Fetch logs for this employee in the date range
    $log_stmt = $pdo->prepare("
        SELECT log_timestamp, log_type 
        FROM attendance_logs 
        WHERE employee_id = ? 
        AND DATE(log_timestamp) BETWEEN ? AND ?
        ORDER BY log_timestamp ASC
    ");
    $log_stmt->execute([$emp_id, $start_date, $end_date]);
    $logs = $log_stmt->fetchAll();

    $daily_logs = [];
    foreach ($logs as $log) {
        $date = date('Y-m-d', strtotime($log['log_timestamp']));
        $time = date('H:i:s', strtotime($log['log_timestamp']));
        
        if (!isset($daily_logs[$date])) {
            $daily_logs[$date] = ['am_in' => null, 'am_out' => null, 'pm_in' => null, 'pm_out' => null];
        }

        // Simple logic to assign logs to slots based on time
        $hour = (int)date('H', strtotime($log['log_timestamp']));
        
        if ($log['log_type'] === 'in') {
            if ($hour < 12 && !$daily_logs[$date]['am_in']) {
                $daily_logs[$date]['am_in'] = $time;
            } else {
                $daily_logs[$date]['pm_in'] = $time;
            }
        } else {
            if ($hour <= 13 && !$daily_logs[$date]['am_out']) {
                $daily_logs[$date]['am_out'] = $time;
            } else {
                $daily_logs[$date]['pm_out'] = $time;
            }
        }
    }
    
    $dtr_data[$emp_id] = [
        'employee' => $employee,
        'logs' => $daily_logs
    ];
}

// Generate Date List for the report
$dates = [];
if ($start_date && $end_date) {
    $current = strtotime($start_date);
    $last = strtotime($end_date);
    while ($current <= $last) {
        $dates[] = date('Y-m-d', $current);
        $current = strtotime('+1 day', $current);
    }
}
?>

<div class="dtr-view-container">
    <div class="no-print" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
        <a href="index.php?page=create-dtr" class="btn btn-outline">
            <i class="ph-bold ph-arrow-left"></i> Back to Config
        </a>
        <button onclick="window.print()" class="btn btn-emerald">
            <i class="ph-bold ph-printer"></i> Print DTRs
        </button>
    </div>

    <?php if (empty($dtr_data)): ?>
        <div class="card">
            <p class="muted" style="text-align: center; padding: 3rem;">No personnel records found matching the criteria.</p>
        </div>
    <?php else: ?>
        <?php foreach ($dtr_data as $emp_id => $data): 
            $emp = $data['employee'];
            $logs = $data['logs'];
        ?>
            <div class="dtr-card">
                <div class="dtr-header">
                    <div class="dtr-title">Civil Service Form No. 48</div>
                    <div class="dtr-main-label">DAILY TIME RECORD</div>
                    <div class="dtr-name-underlined"><?php echo strtoupper(htmlspecialchars($emp['name'])); ?></div>
                    <div class="dtr-sub-label">(Name)</div>
                    
                    <div style="margin-top: 1rem; display: flex; justify-content: space-between; font-size: 0.8rem;">
                        <span>For the month of: <strong><?php echo date('F Y', strtotime($start_date)); ?></strong></span>
                        <span>Official hours: <strong>8:00-12:00 / 1:00-5:00</strong></span>
                    </div>
                </div>

                <table class="dtr-table">
                    <thead>
                        <tr>
                            <th rowspan="2">Day</th>
                            <th colspan="2">A.M.</th>
                            <th colspan="2">P.M.</th>
                            <th colspan="2">Undertime</th>
                        </tr>
                        <tr>
                            <th>Arrival</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Departure</th>
                            <th>Hours</th>
                            <th>Minutes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dates as $date): 
                            $day = date('j', strtotime($date));
                            $log = $logs[$date] ?? ['am_in' => '', 'am_out' => '', 'pm_in' => '', 'pm_out' => ''];
                        ?>
                            <tr>
                                <td style="text-align: center; font-weight: bold;"><?php echo $day; ?></td>
                                <td><?php echo $log['am_in'] ? date('h:i', strtotime($log['am_in'])) : ''; ?></td>
                                <td><?php echo $log['am_out'] ? date('h:i', strtotime($log['am_out'])) : ''; ?></td>
                                <td><?php echo $log['pm_in'] ? date('h:i', strtotime($log['pm_in'])) : ''; ?></td>
                                <td><?php echo $log['pm_out'] ? date('h:i', strtotime($log['pm_out'])) : ''; ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="dtr-footer">
                    <p>I certify on my honor that the above is a true and correct report of the hours of work performed, record of which was made daily at the time of arrival and departure from office.</p>
                    
                    <div style="margin-top: 2rem; border-top: 1px solid #000; width: 250px; margin-left: auto; margin-right: auto; text-align: center; font-weight: bold;">
                        (Signature of Employee)
                    </div>

                    <p style="margin-top: 2rem;">Verified as to the prescribed office hours:</p>
                    
                    <div style="margin-top: 2rem; border-top: 1px solid #000; width: 250px; margin-left: auto; margin-right: auto; text-align: center; font-weight: bold;">
                        <?php echo htmlspecialchars($emp['department_name']); ?> Head
                    </div>
                </div>
            </div>
            
            <div class="page-break"></div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<style>
.dtr-view-container {
    max-width: 800px;
    margin: 0 auto;
}

.dtr-card {
    background: #fff;
    padding: 2.5rem;
    border: 1px solid var(--border-soft);
    border-radius: 8px;
    margin-bottom: 3rem;
    color: #000;
    font-family: 'Times New Roman', serif;
}

.dtr-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.dtr-title { font-size: 0.75rem; font-style: italic; }
.dtr-main-label { font-size: 1.25rem; font-weight: bold; margin: 0.5rem 0; }
.dtr-name-underlined { 
    margin-top: 1.5rem;
    border-bottom: 1px solid #000;
    display: inline-block;
    min-width: 300px;
    font-size: 1.1rem;
    font-weight: bold;
}
.dtr-sub-label { font-size: 0.75rem; margin-bottom: 1rem; }

.dtr-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1.5rem;
}

.dtr-table th, .dtr-table td {
    border: 1px solid #000;
    padding: 4px 8px;
    font-size: 0.85rem;
    height: 25px;
}

.dtr-table th {
    text-align: center;
    background: #f8fafc;
}

.dtr-table td {
    text-align: center;
}

.dtr-footer {
    font-size: 0.8rem;
    line-height: 1.4;
}

.page-break {
    display: none;
}

@media print {
    .no-print { display: none; }
    .sidebar, footer { display: none; }
    .app-layout { display: block; }
    .main-content { padding: 0; }
    .dtr-card { border: none; padding: 0; margin: 0; }
    .page-break { display: block; page-break-after: always; }
    body { background: #fff; }
}
</style>
