<?php
/**
 * Main Entry Point / Router
 */
session_start();

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
            <div class="sidebar-title">DENR<br>DTR System</div>
        </div>
        <nav>
            <a href="index.php?page=dashboard" class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">
                <i class="ph-bold ph-layout"></i> Dashboard
            </a>
            <div style="padding: 1.5rem 1rem 0.5rem; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: var(--zinc-400);">Management</div>
            <a href="index.php?page=create-dtr" class="<?php echo $page == 'create-dtr' ? 'active' : ''; ?>">
                <i class="ph-bold ph-file-text"></i> Create DTR
            </a>
            <a href="index.php?page=manage-employees" class="<?php echo $page == 'manage-employees' ? 'active' : ''; ?>">
                <i class="ph-bold ph-users-three"></i> Employees
            </a>
            <a href="index.php?page=manage-departments" class="<?php echo $page == 'manage-departments' ? 'active' : ''; ?>">
                <i class="ph-bold ph-buildings"></i> Departments
            </a>
        </nav>
        <div style="margin-top: auto; padding: 1.5rem; border-top: 1px solid var(--border-soft);">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--zinc-100); display: flex; align-items: center; justify-content: center; font-size: 0.875rem; font-weight: 700; color: var(--zinc-600);">AD</div>
                <div>
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--zinc-900);">Admin User</div>
                    <div style="font-size: 0.625rem; font-weight: 500; color: var(--zinc-500);">System Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="content-body">
            <main>
                <?php 
                    $view_path = "ui/" . $page . ".php";
                    if (file_exists($view_path)) {
                        include $view_path;
                    } else {
                        echo "<div class='card'><h2>Page not found</h2><p class='muted'>The requested page could not be located in the UI folder.</p></div>";
                    }
                ?>
            </main>

            <footer>
                &copy; <?php echo date('Y'); ?> Department of Environment and Natural Resources
                <div style="margin-top: 0.5rem; font-size: 0.7rem; opacity: 0.6;">DTR Management System v1.0 Prototype</div>
            </footer>
        </div>
    </div>
</div>

<div id="toast-container" class="toast-container">
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="toast">
            <i class="ph-bold ph-check-circle" style="color: var(--primary); font-size: 1.25rem;"></i>
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
