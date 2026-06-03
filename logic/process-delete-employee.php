<?php
session_start();

$id = $_GET['id'] ?? null;

if ($id) {
    foreach ($_SESSION['employees'] as $key => $emp) {
        if ($emp['id'] == $id) {
            $name = $emp['name'];
            unset($_SESSION['employees'][$key]);
            $_SESSION['employees'] = array_values($_SESSION['employees']);
            $_SESSION['flash'] = "Employee '$name' deleted successfully.";
            break;
        }
    }
}

header("Location: ../index.php?page=manage-employees");
exit;
