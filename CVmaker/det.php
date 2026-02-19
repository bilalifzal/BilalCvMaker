<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Logic to Fetch CV Print counts by Professional Field
// This joins the users table with the experience table to count prints per job title
$field_stats_query = "SELECT e.job_title, SUM(u.cv_print_count) as total_prints 
                      FROM users u 
                      JOIN experience e ON u.id = e.user_id 
                      GROUP BY e.job_title 
                      ORDER BY total_prints DESC LIMIT 5";
$field_stats = mysqli_query($conn, $field_stats_query);

// FEATURE: Search Filter
$search_query = "";
if (isset($_POST['search_btn'])) {
    $term = mysqli_real_escape_string($conn, $_POST['search_term']);
    $search_query = " WHERE full_name LIKE '%$term%' OR email LIKE '%$term%' ";
}

// Fetch All Users for Table
$all_users = mysqli_query($conn, "SELECT id, full_name, email, cv_print_count, is_blocked, created_at FROM users $search_query ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details & Field Analytics | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --sidebar-bg: #212529; --accent: #0d6efd; }
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 280px; height: 100vh; position: fixed; background: var(--sidebar-bg); color: white; z-index: 1000; }
        .main-content { margin-left: 280px; padding: 40px; }
        .nav-link { color: #adb5bd; padding: 12px 20px; border-radius: 8px; margin: 5px 15px; }
        .nav-link:hover, .nav-link.active { background: var(--accent); color: white; }
        
        /* New Portion Styling */
        .field-box { background: white; border-radius: 15px; padding: 20px; border-left: 5px solid var(--accent); transition: 0.3s; }
        .field-box:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .user-card { background: #fff; border: none; border-radius: 15px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4 text-center">
        <h4 class="fw-bold text-white">BilalCvMaker</h4>
    </div>
     <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link " href="admin_panel.php"><i class="fas fa-home me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="det.php"><i class="fas fa-users me-2"></i> All Users</a></li>
        <li class="nav-item"><a class="nav-link" href="Anaylsis.php"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
        <li class="nav-item"><a class="nav-link" href="setting.php"><i class="fas fa-cog me-2"></i> System Settings</a></li>
        <hr class="mx-3 border-secondary">
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Secure Logout</a></li>
    </ul>
</div>

<div class="main-content">
    
    <div class="mb-5">
        <h4 class="fw-bold mb-4 text-dark"><i class="fas fa-print text-primary me-2"></i> CV Prints by Primary Fields</h4>
        
        <div class="row g-4">
            <?php while($row = mysqli_fetch_assoc($field_stats)): ?>
            <div class="col-md-4 col-lg-2" style="min-width: 220px;">
                <div class="field-box shadow-sm">
                    <h6 class="text-muted small fw-bold text-uppercase mb-1"><?php echo $row['job_title']; ?></h6>
                    <h3 class="fw-bold mb-0"><?php echo $row['total_prints']; ?></h3>
                    <small class="text-primary">Total Prints</small>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Master User Table</h4>
        <form class="d-flex" method="POST">
            <input type="text" name="search_term" class="form-control me-2" placeholder="Search user...">
            <button name="search_btn" class="btn btn-primary px-4">Search</button>
        </form>
    </div>

    <div class="user-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name & Email</th>
                        <th>Field</th>
                        <th>Status</th>
                        <th>Prints</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($all_users)): ?>
                    <tr>
                        <td>#<?php echo $user['id']; ?></td>
                        <td>
                            <div class="fw-bold"><?php echo $user['full_name']; ?></div>
                            <div class="small text-muted"><?php echo $user['email']; ?></div>
                        </td>
                        <td>
                            <?php 
                                $uid = $user['id'];
                                $j_query = mysqli_query($conn, "SELECT job_title FROM experience WHERE user_id = '$uid' LIMIT 1");
                                $j = mysqli_fetch_assoc($j_query);
                                echo $j ? '<span class="badge bg-light text-dark border">'.$j['job_title'].'</span>' : 'N/A';
                            ?>
                        </td>
                        <td>
                            <span class="badge <?php echo $user['is_blocked'] ? 'bg-danger' : 'bg-success'; ?>">
                                <?php echo $user['is_blocked'] ? 'Blocked' : 'Active'; ?>
                            </span>
                        </td>
                        <td><span class="fw-bold"><?php echo $user['cv_print_count']; ?></span></td>
                        <td class="text-center">
                            <a href="admin_view_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>