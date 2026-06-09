<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $id_num = $_POST['id_num'] ?? '';
    $employee_num = $_POST['employee_num'] ?? '';
    $employee_type = $_POST['employee_type'] ?? 'Regular';
    $department_id = $_POST['department_id'] ?? null;

    if ($id) {
        try {
            $stmt = $pdo->prepare("
                UPDATE employees 
                SET name = ?, id_num = ?, employee_num = ?, employee_type = ?, department_id = ? 
                WHERE id = ?
            ");
            $stmt->execute([$name, $id_num, $employee_num, $employee_type, $department_id, $id]);
            
            $_SESSION['flash'] = "Employee profile updated successfully.";
        } catch (PDOException $e) {
            $_SESSION['flash'] = "Error updating employee: " . $e->getMessage();
        }
    }

    header("Location: ../index.php?page=manage-employees");
    exit;
}
