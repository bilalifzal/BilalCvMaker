<?php
include 'config.php';
session_start();

// Security Guard
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$msg = "";

// 1. DYNAMIC AUTO-FIX: Create tables if they are missing
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS system_settings (
    id INT PRIMARY KEY DEFAULT 1, 
    site_title VARCHAR(255), 
    admin_email VARCHAR(255), 
    maintenance_mode TINYINT DEFAULT 0, 
    print_limit INT DEFAULT 10, 
    smtp_host VARCHAR(255)
)");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS templates (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(255), 
    is_active TINYINT DEFAULT 1
)");

// 2. LOGIC: Update Global Configuration & SMTP
if (isset($_POST['update_all_settings'])) {
    $title = mysqli_real_escape_string($conn, $_POST['site_title']);
    $email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $m_mode = $_POST['maintenance_mode'];
    $p_limit = (int)$_POST['print_limit'];
    $host = mysqli_real_escape_string($conn, $_POST['smtp_host']);
    
    $update = mysqli_query($conn, "INSERT INTO system_settings (id, site_title, admin_email, maintenance_mode, print_limit, smtp_host) 
                VALUES (1, '$title', '$email', '$m_mode', '$p_limit', '$host') 
                ON DUPLICATE KEY UPDATE 
                site_title='$title', admin_email='$email', maintenance_mode='$m_mode', print_limit='$p_limit', smtp_host='$host'");
    
    if($update) $msg = "System Settings Updated Successfully!";
}

// 3. LOGIC: Template Toggle (Activate/Disable)
if (isset($_GET['toggle_t'])) {
    $tid = (int)$_GET['toggle_t'];
    $status = (int)$_GET['s'];
    mysqli_query($conn, "UPDATE templates SET is_active='$status' WHERE id='$tid'");
    header("Location: setting.php?msg=StatusChanged");
    exit();
}

// 4. LOGIC: Template Upload/Add
if (isset($_POST['upload_template'])) {
    $t_name = mysqli_real_escape_string($conn, $_POST['t_name']);
    mysqli_query($conn, "INSERT INTO templates (name, is_active) VALUES ('$t_name', 1)");
    $msg = "New template design added to system!";
}

// Fetch Current Data
$st_res = mysqli_query($conn, "SELECT * FROM system_settings WHERE id=1");
$st = mysqli_fetch_assoc($st_res);
$templates = mysqli_query($conn, "SELECT * FROM templates ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ultimate Settings | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --sidebar-bg: #1a1d20; --accent: #0d6efd; --card-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { width: 280px; height: 100vh; position: fixed; background: var(--sidebar-bg); color: white; }
        .main-content { margin-left: 280px; padding: 40px; }
        .nav-link { color: #8e949a; padding: 12px 20px; border-radius: 8px; margin: 5px 15px; text-decoration: none; display: block; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background: var(--accent); color: white; box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3); }
        .setting-card { background: white; border-radius: 20px; padding: 30px; box-shadow: var(--card-shadow); border: none; margin-bottom: 30px; }
        .section-header { border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 25px; display: flex; align-items: center; }
        .section-header i { font-size: 1.2rem; margin-right: 15px; color: var(--accent); }
        .template-box { border: 1px solid #eee; border-radius: 12px; transition: 0.3s; padding: 15px; background: #f8f9fa; }
        .template-box:hover { border-color: var(--accent); background: #fff; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4 text-center border-bottom border-secondary mb-4">
        <h4 class="fw-bold mb-0 text-white">BilalCvMaker</h4>
        <small class="text-muted">Command Center v4.0</small>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="admin_panel.php"><i class="fas fa-home me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="det.php"><i class="fas fa-users me-2"></i> All Users</a></li>
        <li class="nav-item"><a class="nav-link " href="Anaylsis.php"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
        <li class="nav-item"><a class="nav-link active" href="setting.php"><i class="fas fa-cog me-2"></i> System Settings</a></li>
        <li class="nav-item mt-5"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Shutdown</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold mb-1">Global System Control Center ⚙️</h2>
            <p class="text-muted">Manage your core configurations and CV templates.</p>
        </div>
        <?php if($msg || isset($_GET['msg'])) : ?>
            <div class="alert alert-success py-2 px-4 rounded-pill shadow-sm animate__animated animate__fadeIn">
                <i class="fas fa-check-circle me-2"></i> <?php echo $msg ?: "Status Updated!"; ?>
            </div>
        <?php endif; ?>
    </div>

    <form method="POST">
        <div class="row">
            <div class="col-lg-8">
                <div class="setting-card">
                    <div class="section-header">
                        <i class="fas fa-tools"></i>
                        <h5 class="fw-bold mb-0">Website & Global Configuration</h5>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Site Display Title</label>
                            <input type="text" name="site_title" class="form-control" value="<?php echo $st['site_title'] ?? 'BilalCvMaker'; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Support Email</label>
                            <input type="email" name="admin_email" class="form-control" value="<?php echo $st['admin_email'] ?? 'admin@test.com'; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">SMTP Host</label>
                            <input type="text" name="smtp_host" class="form-control" placeholder="e.g. smtp.gmail.com" value="<?php echo $st['smtp_host'] ?? ''; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">System Status</label>
                            <select name="maintenance_mode" class="form-select">
                                <option value="0" <?php echo (@$st['maintenance_mode'] == 0) ? 'selected' : ''; ?>>Live (Public Access)</option>
                                <option value="1" <?php echo (@$st['maintenance_mode'] == 1) ? 'selected' : ''; ?>>Maintenance Mode</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="setting-card">
                    <div class="section-header justify-content-between w-100">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-layer-group"></i>
                            <h5 class="fw-bold mb-0">CV Template Manager</h5>
                        </div>
                        <button type="button" class="btn btn-sm btn-dark px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#addT">
                            <i class="fas fa-plus me-1"></i> Add New
                        </button>
                    </div>
                    <div class="row g-3">
                        <?php while($t = mysqli_fetch_assoc($templates)): ?>
                        <div class="col-md-6">
                            <div class="template-box d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0 fw-bold"><?php echo $t['name']; ?></h6>
                                    <small class="<?php echo $t['is_active'] ? 'text-success' : 'text-danger'; ?>">
                                        <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                                        <?php echo $t['is_active'] ? 'Active' : 'Offline'; ?>
                                    </small>
                                </div>
                                <a href="setting.php?toggle_t=<?php echo $t['id']; ?>&s=<?php echo $t['is_active'] ? 0 : 1; ?>" 
                                   class="btn btn-sm <?php echo $t['is_active'] ? 'btn-outline-danger' : 'btn-success'; ?> rounded-pill px-3">
                                   <?php echo $t['is_active'] ? 'Disable' : 'Enable'; ?>
                                </a>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="setting-card text-center py-5">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="https://ui-avatars.com/api/?name=Muhammad+Bilal&size=100&background=0d6efd&color=fff" class="rounded-circle shadow-sm">
                        <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-2"></span>
                    </div>
                    <h5 class="fw-bold mb-0">Muhammad Bilal Ifzal</h5>
                    <p class="text-muted small">System Administrator</p>
                    <div class="bg-light p-2 rounded-3 small text-muted mb-4 border border-dashed">CNIC: 3310037101209</div>
                    
                    <div class="text-start mb-4">
                        <label class="small fw-bold text-muted mb-1">Max Prints Per User</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white"><i class="fas fa-print"></i></span>
                            <input type="number" name="print_limit" class="form-control" value="<?php echo $st['print_limit'] ?? 10; ?>">
                        </div>
                    </div>

                    <button type="submit" name="update_all_settings" class="btn btn-primary w-100 shadow-sm py-2">
                        <i class="fas fa-save me-2"></i> Save All Changes
                    </button>
                </div>

                <div class="setting-card">
                    <h6 class="fw-bold mb-3"><i class="fas fa-heartbeat text-danger me-2"></i> System Health</h6>
                    <div class="d-flex justify-content-between small mb-3">
                        <span class="text-muted">Database Connection</span>
                        <span class="text-success fw-bold">ONLINE</span>
                    </div>
                    <div class="d-flex justify-content-between small mb-3">
                        <span class="text-muted">Storage Availability</span>
                        <span class="text-primary fw-bold">82% Free</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: 18%"></div>
                    </div>
                    <button type="button" class="btn btn-sm btn-light w-100 mt-4 border">Check for Updates</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="addT" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content border-0 shadow-lg" method="POST">
            <div class="modal-header border-0 bg-light">
                <h5 class="modal-title fw-bold">Deploy New CV Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="small fw-bold mb-1">Template Name (e.g. Modern Professional)</label>
                    <input type="text" name="t_name" class="form-control shadow-sm" required>
                </div>
                <div class="p-3 bg-light rounded-3 small border">
                    <i class="fas fa-info-circle text-primary me-2"></i> After adding, please ensure the <code>.php</code> source file is placed in your templates directory.
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="submit" name="upload_template" class="btn btn-primary px-5 rounded-pill">Deploy Now</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>