<?php
/**
 * Main Entry Point / Router
 */
session_start();

// Initialize session arrays if they don't exist
if (!isset($_SESSION['employees'])) $_SESSION['employees'] = [];
if (!isset($_SESSION['departments'])) $_SESSION['departments'] = [];
if (!isset($_SESSION['manual_logs'])) $_SESSION['manual_logs'] = [];

// Simple routing based on 'page' parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Define allowed pages to prevent directory traversal
$allowed_pages = ['dashboard', 'create-dtr', 'manage-employees', 'manage-departments', 'edit-employee', 'edit-department'];

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
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="app-layout">
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="assets/Images/denr.png" alt="DENR Logo" class="sidebar-logo">
            <div class="sidebar-title">DENR DTR<br>System</div>
        </div>
        <nav>
            <a href="index.php?page=dashboard" class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">
                <i class="ph-bold ph-house-line"></i> Dashboard
            </a>
            <a href="index.php?page=create-dtr" class="<?php echo $page == 'create-dtr' ? 'active' : ''; ?>">
                <i class="ph-bold ph-file-text"></i> Create DTR
            </a>
            <a href="index.php?page=manage-employees" class="<?php echo $page == 'manage-employees' ? 'active' : ''; ?>">
                <i class="ph-bold ph-users"></i> Employees
            </a>
            <a href="index.php?page=manage-departments" class="<?php echo $page == 'manage-departments' ? 'active' : ''; ?>">
                <i class="ph-bold ph-buildings"></i> Departments
            </a>
        </nav>
    </aside>

    <div class="main-content">
        <div class="content-body">
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
                <div style="text-align: center;">
                    &copy; <?php echo date('Y'); ?> DENR DTR System Prototype
                </div>
            </footer>
        </div>
    </div>
</div>

<div id="toast-container" class="toast-container">
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="toast toast-success">
            <span>✓</span>
            <span><?php echo htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></span>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Micro-feedback for buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Only add loading if it's a submit button
            if (this.type === 'submit') {
                const originalText = this.innerText;
                this.style.width = this.offsetWidth + 'px';
                this.innerHTML = '<span class="loading-spinner"></span> Processing...';
                this.style.opacity = '0.8';
                this.style.pointerEvents = 'none';
            }
        });
    });

    // Auto-hide toasts
    setTimeout(() => {
        document.querySelectorAll('.toast').forEach(toast => {
            toast.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(20px)';
            setTimeout(() => toast.remove(), 500);
        });
    }, 4000);
</script>
<style>
    .loading-spinner {
        display: inline-block;
        width: 12px;
        height: 12px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 0.8s linear infinite;
        margin-right: 8px;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>
</body>
</html>
