<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate a simple ID
    $id = count($_SESSION['employees']) + 1;
    
    $new_employee = [
        'id' => $id,
        'name' => $_POST['name'] ?? '',
        'id_num' => $_POST['id_num'] ?? '',
        'employee_num' => $_POST['employee_num'] ?? '',
        'employee_type' => $_POST['employee_type'] ?? '',
        'department_id' => $_POST['department_id'] ?? ''
    ];

    $_SESSION['employees'][] = $new_employee;
    $_SESSION['flash'] = "Employee '" . $new_employee['name'] . "' saved successfully.";

    // Redirect back to manage employees page
    header("Location: ../index.php?page=manage-employees");
    exit;
}
