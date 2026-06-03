<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = count($_SESSION['departments']) + 1;
    
    // Reconstruct time strings from separate fields
    $am_arrival = ($_POST['am_arrival_h'] ?? '08') . ":" . ($_POST['am_arrival_m'] ?? '00') . " " . ($_POST['am_arrival_ap'] ?? 'AM');
    $am_departure = ($_POST['am_departure_h'] ?? '12') . ":" . ($_POST['am_departure_m'] ?? '00') . " " . ($_POST['am_departure_ap'] ?? 'PM');
    $pm_arrival = ($_POST['pm_arrival_h'] ?? '01') . ":" . ($_POST['pm_arrival_m'] ?? '00') . " " . ($_POST['pm_arrival_ap'] ?? 'PM');
    $pm_departure = ($_POST['pm_departure_h'] ?? '05') . ":" . ($_POST['pm_departure_m'] ?? '00') . " " . ($_POST['pm_departure_ap'] ?? 'PM');

    $new_dept = [
        'id' => $id,
        'name' => $_POST['department_name'] ?? '',
        'head' => $_POST['department_head'] ?? '',
        'am_arrival' => $am_arrival,
        'am_departure' => $am_departure,
        'pm_arrival' => $pm_arrival,
        'pm_departure' => $pm_departure
    ];

    $_SESSION['departments'][] = $new_dept;
    $_SESSION['flash'] = "Department '" . $new_dept['name'] . "' schedule updated.";

    header("Location: ../index.php?page=manage-departments");
    exit;
}
