<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    
    if ($id) {
        foreach ($_SESSION['employees'] as &$emp) {
            if ($emp['id'] == $id) {
                $emp['name'] = $_POST['name'] ?? $emp['name'];
                $emp['id_num'] = $_POST['id_num'] ?? $emp['id_num'];
                $emp['employee_num'] = $_POST['employee_num'] ?? $emp['employee_num'];
                $emp['employee_type'] = $_POST['employee_type'] ?? $emp['employee_type'];
                $emp['department_id'] = $_POST['department_id'] ?? $emp['department_id'];
                
                $_SESSION['flash'] = "Employee '" . $emp['name'] . "' updated successfully.";
                break;
            }
        }
    }

    header("Location: ../index.php?page=manage-employees");
    exit;
}
