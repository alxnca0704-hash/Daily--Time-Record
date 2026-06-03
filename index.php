<?php
/**
 * Main Entry Point / Router
 */

// Simple routing based on 'page' parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Define allowed pages to prevent directory traversal
$allowed_pages = ['dashboard', 'create-dtr', 'manage-employees', 'manage-departments'];

if (!in_array($page, $allowed_pages)) {
    $page = 'dashboard';
}

// Layout Wrapper`
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENR DTR System Prototype</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <div class="container">
        <h1>DENR Daily Time Record System</h1>
    </div>
</header>

<div class="container">
    <nav>
        <a href="index.php?page=dashboard" class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
        <a href="index.php?page=create-dtr" class="<?php echo $page == 'create-dtr' ? 'active' : ''; ?>">Create DTR</a>
        <a href="index.php?page=manage-employees" class="<?php echo $page == 'manage-employees' ? 'active' : ''; ?>">Manage Employees</a>
        <a href="index.php?page=manage-departments" class="<?php echo $page == 'manage-departments' ? 'active' : ''; ?>">Manage Departments</a>
    </nav>

    <main>
        <?php 
            $view_path = "ui/" . $page . ".php";
            if (file_exists($view_path)) {
                include $view_path;
            } else {
                echo "<div class='card'><h2>Page not found</h2><p>The requested page could not be located in the UI folder.</p></div>";
            }
        ?>
    </main>

    <footer>
        <div class="container" style="text-align: center;">
            &copy; <?php echo date('Y'); ?> DENR DTR System Prototype
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>
