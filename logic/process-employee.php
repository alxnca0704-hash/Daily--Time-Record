<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $id_num = $_POST['id_num'] ?? '';
    $employee_num = $_POST['employee_num'] ?? '';
    $employee_type = $_POST['employee_type'] ?? 'Regular';
    $department_id = $_POST['department_id'] ?? null;

    try {
        $stmt = $pdo->prepare("INSERT INTO employees (name, id_num, employee_num, employee_type, department_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $id_num, $employee_num, $employee_type, $department_id]);
        
        $_SESSION['flash'] = "Employee '" . htmlspecialchars($name) . "' saved successfully.";
    } catch (PDOException $e) {
        $_SESSION['flash'] = "Error saving employee: " . $e->getMessage();
    }

    // Redirect back to manage employees page
    header("Location: ../index.php?page=manage-employees");
    exit;
}
