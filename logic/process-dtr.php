<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $report_type = $_POST['report_type'] ?? 'all';
    $date_range = $_POST['date_range'] ?? '';
    $employee_name = $_POST['employee_name'] ?? '';
    $department_id = $_POST['department_id'] ?? '';

    // 1. Handle File Upload (CSV Import)
    if (isset($_FILES['report_file']) && $_FILES['report_file']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['report_file']['tmp_name'];
        $handle = fopen($file_tmp, 'r');
        
        // Skip header row
        fgetcsv($handle);

        $imported_count = 0;
        $error_count = 0;

        while (($data = fgetcsv($handle)) !== FALSE) {
            // Standard format: id_num, name, log_timestamp, log_type
            if (count($data) >= 4) {
                $id_num = trim($data[0]);
                $log_timestamp = trim($data[2]);
                $log_type = strtolower(trim($data[3])); // 'in' or 'out'

                // Find employee by id_num
                $emp_stmt = $pdo->prepare("SELECT id FROM employees WHERE id_num = ? LIMIT 1");
                $emp_stmt->execute([$id_num]);
                $employee = $emp_stmt->fetch();

                if ($employee) {
                    try {
                        // Check for duplicate logs to prevent double entry
                        $check_stmt = $pdo->prepare("SELECT id FROM attendance_logs WHERE employee_id = ? AND log_timestamp = ? AND log_type = ?");
                        $check_stmt->execute([$employee['id'], $log_timestamp, $log_type]);
                        
                        if (!$check_stmt->fetch()) {
                            $insert_stmt = $pdo->prepare("INSERT INTO attendance_logs (employee_id, log_type, log_timestamp, source) VALUES (?, ?, ?, 'biometric')");
                            $insert_stmt->execute([$employee['id'], $log_type, $log_timestamp]);
                            $imported_count++;
                        }
                    } catch (PDOException $e) {
                        $error_count++;
                    }
                }
            }
        }
        fclose($handle);
        $_SESSION['flash'] = "Import completed: $imported_count records added. Errors: $error_count.";
    }

    // 2. Redirect to View Page with filters
    $query = http_build_query([
        'page' => 'view-dtr',
        'type' => $report_type,
        'range' => $date_range,
        'emp' => $employee_name,
        'dept' => $department_id
    ]);

    header("Location: ../index.php?$query");
    exit;
}
