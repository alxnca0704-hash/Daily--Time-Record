<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = count($_SESSION['manual_logs']) + 1;
    
    $new_log = [
        'id' => $id,
        'employee' => $_POST['adj_employee'] ?? '',
        'type' => $_POST['log_type'] ?? '',
        'datetime' => $_POST['adjustment_datetime'] ?? ''
    ];

    $_SESSION['manual_logs'][] = $new_log;
    $_SESSION['flash'] = "Manual log for " . $new_log['employee'] . " recorded.";

    header("Location: ../index.php?page=create-dtr");
    exit;
}
