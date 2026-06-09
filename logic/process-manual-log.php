<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adj_employee = $_POST['adj_employee'] ?? '';
    $log_type = $_POST['log_type'] ?? 'in';
    $log_timestamp = $_POST['adjustment_datetime'] ?? date('Y-m-d H:i:s');

    try {
        // Find employee ID by name or id_num
        $emp_stmt = $pdo->prepare("SELECT id FROM employees WHERE name LIKE ? OR id_num = ? LIMIT 1");
        $emp_stmt->execute(["%$adj_employee%", $adj_employee]);
        $employee = $emp_stmt->fetch();

        if ($employee) {
            $stmt = $pdo->prepare("
                INSERT INTO attendance_logs (employee_id, log_type, log_timestamp, source) 
                VALUES (?, ?, ?, 'manual')
            ");
            $stmt->execute([$employee['id'], $log_type, $log_timestamp]);
            $_SESSION['flash'] = "Manual adjustment for " . htmlspecialchars($adj_employee) . " recorded.";
        } else {
            $_SESSION['flash'] = "Error: Personnel not found.";
        }
    } catch (PDOException $e) {
        $_SESSION['flash'] = "Error: " . $e->getMessage();
    }

    header("Location: ../index.php?page=create-dtr");
    exit;
}
