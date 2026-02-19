<?php
include 'config.php';
session_start();

// Final Security Guard
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// FEATURE: Delete Logic
if (isset($_GET['delete_id'])) {
    $del_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM users WHERE id = '$del_id'");
    header("Location: admin_panel.php?msg=deleted");
    exit();
}

// FEATURE: Search Filter
$search_query = "";
if (isset($_POST['search_btn'])) {
    $term = mysqli_real_escape_string($conn, $_POST['search_term']);
    $search_query = " WHERE full_name LIKE '%$term%' OR email LIKE '%$term%' ";
}

// Statistics Queries
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$total_prints = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(cv_print_count) as total FROM users"))['total'] ?? 0;
$blocked_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE is_blocked = 1"))['total'];

// Analytics: Users who joined in the last 24 hours
$recent_joins = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE created_at >= NOW() - INTERVAL 1 DAY"))['total'] ?? 0;

// Fetch All Users for Table
$all_users = mysqli_query($conn, "SELECT id, full_name, email, cv_print_count, is_blocked FROM users $search_query ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --sidebar-bg: #212529; --accent-color: #0d6efd; }
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        
        /* Sidebar Styling */
        .sidebar { width: 280px; height: 100vh; position: fixed; background: var(--sidebar-bg); color: white; transition: 0.3s; z-index: 1000; }
        .main-content { margin-left: 280px; padding: 40px; }
        .nav-link { color: #adb5bd; padding: 12px 20px; border-radius: 8px; margin: 5px 15px; }
        .nav-link:hover, .nav-link.active { background: var(--accent-color); color: white; }
        
        /* Stats Card Styling (Original Layout) */
        .stat-card { border: none; border-radius: 15px; padding: 25px; transition: 0.3s; background: #fff; height: 100%; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-icon { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 24px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4 text-center">
        <h4 class="fw-bold">BilalCvMaker</h4>
        <p class="small text-muted">Admin Control Panel</p>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active" href="admin_panel.php"><i class="fas fa-home me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="det.php"><i class="fas fa-users me-2"></i> All Users</a></li>
        <li class="nav-item"><a class="nav-link" href="Anaylsis.php"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
        <li class="nav-item"><a class="nav-link" href="setting.php"><i class="fas fa-cog me-2"></i> System Settings</a></li>
        <hr class="mx-3 border-secondary">
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Secure Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold">Welcome, Muhammad Bilal Ifzal 👋</h2>
            <p class="text-muted">System Overview and User Management</p>
        </div>
        <div class="d-flex align-items-center">
            <form class="d-flex me-3" method="POST">
                <input type="text" name="search_term" class="form-control me-2" placeholder="Search users...">
                <button name="search_btn" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
            </form>
            <div class="text-end text-muted small">
                Last Login: <?php echo date('d M, Y | h:i A'); ?>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="card-icon bg-primary text-white me-3"><i class="fas fa-users"></i></div>
                    <div>
                        <h6 class="text-muted mb-0">Total Users</h6>
                        <h3 class="fw-bold mb-0"><?php echo $total_users; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="card-icon bg-success text-white me-3"><i class="fas fa-print"></i></div>
                    <div>
                        <h6 class="text-muted mb-0">Total Prints</h6>
                        <h3 class="fw-bold mb-0"><?php echo $total_prints; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="card-icon bg-warning text-dark me-3"><i class="fas fa-chart-line"></i></div>
                    <div>
                        <h6 class="text-muted mb-0">New (24h)</h6>
                        <h3 class="fw-bold mb-0"><?php echo $recent_joins; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="card-icon bg-danger text-white me-3"><i class="fas fa-user-slash"></i></div>
                    <div>
                        <h6 class="text-muted mb-0">Blocked</h6>
                        <h3 class="fw-bold mb-0"><?php echo $blocked_users; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0"><i class="fas fa-table me-2"></i>User Database</h5>
            <?php if(isset($_GET['msg'])) echo '<span class="badge bg-success">User Successfully Deleted</span>'; ?>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Print Count</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($all_users)): ?>
                    <tr>
                        <td>#<?php echo $user['id']; ?></td>
                        <td>
                            <strong><?php echo $user['full_name']; ?></strong>
                            <?php if($user['is_blocked'] == 1): ?>
                                <span class="badge bg-danger ms-1" style="font-size: 0.6rem;">BLOCKED</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <span class="badge bg-info text-dark px-3 py-2">
                                <?php echo $user['cv_print_count']; ?> Prints
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="admin_view_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-eye me-1"></i> View Details
                            </a>
                            <a href="admin_panel.php?delete_id=<?php echo $user['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user permanently?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="mt-5 text-center text-muted py-4 border-top">
        <p class="mb-0">Administrator: Muhammad Bilal Ifzal | CNIC: 3310037101209</p>
        <small>&copy; 2026 BilalCvMaker System Security</small>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>