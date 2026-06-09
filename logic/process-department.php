<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['department_id'] ?? 'new';
    $name = $_POST['name'] ?? '';
    $head = $_POST['head'] ?? '';
    $am_arrival = $_POST['am_arrival'] ?? '08:00:00';
    $am_departure = $_POST['am_departure'] ?? '12:00:00';
    $pm_arrival = $_POST['pm_arrival'] ?? '13:00:00';
    $pm_departure = $_POST['pm_departure'] ?? '17:00:00';

    try {
        if ($id === 'new') {
            $stmt = $pdo->prepare("
                INSERT INTO departments (name, head, am_arrival, am_departure, pm_arrival, pm_departure) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$name, $head, $am_arrival, $am_departure, $pm_arrival, $pm_departure]);
            $_SESSION['flash'] = "Department '" . htmlspecialchars($name) . "' created.";
        } else {
            $stmt = $pdo->prepare("
                UPDATE departments 
                SET name = ?, head = ?, am_arrival = ?, am_departure = ?, pm_arrival = ?, pm_departure = ? 
                WHERE id = ?
            ");
            $stmt->execute([$name, $head, $am_arrival, $am_departure, $pm_arrival, $pm_departure, $id]);
            $_SESSION['flash'] = "Department '" . htmlspecialchars($name) . "' updated.";
        }
    } catch (PDOException $e) {
        $_SESSION['flash'] = "Error: " . $e->getMessage();
    }

    header("Location: ../index.php?page=manage-departments");
    exit;
}
