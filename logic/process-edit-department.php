<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    
    if ($id) {
        foreach ($_SESSION['departments'] as &$dept) {
            if ($dept['id'] == $id) {
                $am_arrival = ($_POST['am_arrival_h'] ?? '08') . ":" . ($_POST['am_arrival_m'] ?? '00') . " " . ($_POST['am_arrival_ap'] ?? 'AM');
                $am_departure = ($_POST['am_departure_h'] ?? '12') . ":" . ($_POST['am_departure_m'] ?? '00') . " " . ($_POST['am_departure_ap'] ?? 'PM');
                $pm_arrival = ($_POST['pm_arrival_h'] ?? '01') . ":" . ($_POST['pm_arrival_m'] ?? '00') . " " . ($_POST['pm_arrival_ap'] ?? 'PM');
                $pm_departure = ($_POST['pm_departure_h'] ?? '05') . ":" . ($_POST['pm_departure_m'] ?? '00') . " " . ($_POST['pm_departure_ap'] ?? 'PM');

                $dept['name'] = $_POST['department_name'] ?? $dept['name'];
                $dept['head'] = $_POST['department_head'] ?? $dept['head'];
                $dept['am_arrival'] = $am_arrival;
                $dept['am_departure'] = $am_departure;
                $dept['pm_arrival'] = $pm_arrival;
                $dept['pm_departure'] = $pm_departure;
                
                $_SESSION['flash'] = "Department '" . $dept['name'] . "' updated successfully.";
                break;
            }
        }
    }

    header("Location: ../index.php?page=manage-departments");
    exit;
}
