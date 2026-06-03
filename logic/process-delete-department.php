<?php
session_start();

$id = $_GET['id'] ?? null;

if ($id) {
    foreach ($_SESSION['departments'] as $key => $dept) {
        if ($dept['id'] == $id) {
            $name = $dept['name'];
            unset($_SESSION['departments'][$key]);
            // Re-index array
            $_SESSION['departments'] = array_values($_SESSION['departments']);
            $_SESSION['flash'] = "Department '$name' deleted successfully.";
            break;
        }
    }
}

header("Location: ../index.php?page=manage-departments");
exit;
