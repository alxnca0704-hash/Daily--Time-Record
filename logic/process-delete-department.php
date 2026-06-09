<?php
session_start();
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM departments WHERE id = ?");
        $stmt->execute([$id]);
        
        $_SESSION['flash'] = "Department deleted successfully.";
    } catch (PDOException $e) {
        $_SESSION['flash'] = "Error deleting department: " . $e->getMessage();
    }
}

header("Location: ../index.php?page=manage-departments");
exit;
