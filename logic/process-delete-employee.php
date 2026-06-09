<?php
session_start();
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
        $stmt->execute([$id]);
        
        $_SESSION['flash'] = "Employee record deleted successfully.";
    } catch (PDOException $e) {
        $_SESSION['flash'] = "Error deleting employee: " . $e->getMessage();
    }
}

header("Location: ../index.php?page=manage-employees");
exit;
