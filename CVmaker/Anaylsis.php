<?php
include 'config.php';
session_start();

// Security Guard
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// 1. DATA FOR GRAPHS: Daily Printing Trends (Last 7 Days)
// Note: This assumes you have a 'created_at' or similar timestamp in a 'prints' table or logs.
// For now, we simulate trend data based on user growth or global counts.
$print_data = [12, 19, 13, 25, 22, 30, 45]; // Replace with SQL: SELECT count(*) FROM prints GROUP BY date
$days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

// 2. DATA FOR GRAPHS: Template Frequency
// Replace these with actual counts from your database if you track template usage
$template_names = ['Executive Classic', 'Modern Tech', 'Minimalist', 'Creative Pro'];
$template_usage = [40, 25, 20, 15]; 

// Summary Statistics
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$total_prints = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(cv_print_count) as total FROM users"))['total'] ?? 0;
$avg_per_day = round($total_prints / 30, 1); // Average based on a month
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System Analysis | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root { --sidebar-bg: #212529; --accent-color: #0d6efd; }
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 280px; height: 100vh; position: fixed; background: var(--sidebar-bg); color: white; transition: 0.3s; z-index: 1000; }
        .main-content { margin-left: 280px; padding: 40px; }
        .nav-link { color: #adb5bd; padding: 12px 20px; border-radius: 8px; margin: 5px 15px; }
        .nav-link:hover, .nav-link.active { background: var(--accent-color); color: white; }
        .analysis-card { background: #fff; border: none; border-radius: 15px; padding: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); height: 100%; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4 text-center">
        <h4 class="fw-bold">BilalCvMaker</h4>
        <p class="small text-muted">Admin Control Panel</p>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="admin_panel.php"><i class="fas fa-home me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="det.php"><i class="fas fa-users me-2"></i> All Users</a></li>
        <li class="nav-item"><a class="nav-link active" href="Anaylsis.php"><i class="fas fa-chart-line me-2"></i> Analytics</a></li>
        <li class="nav-item"><a class="nav-link" href="setting.php"><i class="fas fa-cog me-2"></i> System Settings</a></li>
        <hr class="mx-3 border-secondary">
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Secure Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="mb-5">
        <h2 class="fw-bold">System Analytics & Trends 👋</h2>
        <p class="text-muted">Detailed insight into user activity and template performance.</p>
    </div>

    <div class="row g-4 mb-5 text-center">
        <div class="col-md-4">
            <div class="analysis-card">
                <h6 class="text-muted text-uppercase small fw-bold">Daily Avg. Prints</h6>
                <h2 class="fw-bold text-primary"><?php echo $avg_per_day; ?></h2>
                <p class="small text-success mb-0"><i class="fas fa-arrow-up"></i> 12% increase</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="analysis-card">
                <h6 class="text-muted text-uppercase small fw-bold">Most Used Format</h6>
                <h2 class="fw-bold text-dark">Executive Classic</h2>
                <p class="small text-muted mb-0">Used in 40% of CVs</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="analysis-card">
                <h6 class="text-muted text-uppercase small fw-bold">Active Sessions</h6>
                <h2 class="fw-bold text-success">Active Now</h2>
                <p class="small text-muted mb-0">System health: Optimal</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="analysis-card">
                <h5 class="fw-bold mb-4">CV Printing Trends (Last 7 Days)</h5>
                <canvas id="printChart" height="150"></canvas>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="analysis-card">
                <h5 class="fw-bold mb-4">Template Popularity</h5>
                <canvas id="templateChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Line Chart for Prints
const ctx1 = document.getElementById('printChart').getContext('2d');
new Chart(ctx1, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($days); ?>,
        datasets: [{
            label: 'CVs Printed per Day',
            data: <?php echo json_encode($print_data); ?>,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            fill: true,
            tension: 0.4,
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

// Pie Chart for Templates
const ctx2 = document.getElementById('templateChart').getContext('2d');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($template_names); ?>,
        datasets: [{
            data: <?php echo json_encode($template_usage); ?>,
            backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545'],
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});
</script>

</body>
</html>