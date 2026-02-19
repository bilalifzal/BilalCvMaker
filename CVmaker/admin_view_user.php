<?php
include 'config.php';
session_start();

// Admin Access Security
if (!isset($_SESSION['admin_logged_in'])) { header("Location: admin_login.php"); exit(); }

if (isset($_GET['id'])) {
    $uid = mysqli_real_escape_string($conn, $_GET['id']);

    // Handle User Blocking Logic
    if (isset($_POST['toggle_block'])) {
        $status = ($_POST['current_status'] == 0) ? 1 : 0;
        mysqli_query($conn, "UPDATE users SET is_blocked = '$status' WHERE id = '$uid'");
    }

    // Fetch User Data
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$uid'"));
    if (!$user) { die("Error: User record not found."); }

    // Fetch Content Tables
    $edu = mysqli_query($conn, "SELECT * FROM education WHERE user_id = '$uid'");
    $exp = mysqli_query($conn, "SELECT * FROM experience WHERE user_id = '$uid'");
    $pro = mysqli_query($conn, "SELECT * FROM projects WHERE user_id = '$uid'");
} else {
    header("Location: admin_panel.php"); exit();
}

include 'header.php'; 
?>

<style>
    .admin-main { background: #f8f9fa; padding: 40px 0; min-height: 90vh; color: #333; }
    .info-card { background: #fff; border: 1px solid #dee2e6; border-radius: 4px; padding: 0; }
    .status-bar { padding: 15px 25px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
    .user-profile-header { background: #fff; padding: 30px; border-bottom: 4px solid #0d6efd; }
    .data-grid { padding: 30px; }
    .data-label { font-weight: 700; color: #666; font-size: 0.8rem; text-transform: uppercase; margin-bottom: 5px; }
    .data-value { font-size: 1rem; color: #111; margin-bottom: 20px; }
    .not-added { color: #ccc; font-style: italic; font-size: 0.9rem; }
    .section-divider { font-weight: bold; font-size: 1.1rem; border-left: 4px solid #212529; padding-left: 15px; margin: 30px 0 20px; }
    .table-simple { width: 100%; margin-top: 10px; }
    .table-simple th { color: #888; border-bottom: 1px solid #eee; padding: 10px; font-size: 0.85rem; }
    .table-simple td { padding: 10px; border-bottom: 1px solid #f9f9f9; }
</style>

<div class="admin-main">
    <div class="container">
        
        <div class="row mb-3 g-2">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 text-center">
                    <small class="text-muted d-block">Security Status</small>
                    <strong class="<?php echo ($user['is_blocked'] ?? 0) == 1 ? 'text-danger' : 'text-success'; ?>">
                        <i class="fas fa-shield-alt"></i> <?php echo ($user['is_blocked'] ?? 0) == 1 ? 'ACCOUNT BLOCKED' : 'ACCOUNT ACTIVE'; ?>
                    </strong>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-3 text-center">
                    <small class="text-muted d-block">User Last Seen Online</small>
                    <strong class="text-primary">
                        <i class="fas fa-clock"></i> 
                        <?php echo !empty($user['last_login']) ? date('F d, Y | h:i A', strtotime($user['last_login'])) : 'No login recorded yet'; ?>
                    </strong>
                </div>
            </div>
        </div>

        <div class="info-card shadow-sm">
            <div class="user-profile-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-light p-3 border rounded me-3 text-center" style="width: 80px;">
                        <i class="fas fa-user-cog fa-2x text-secondary"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0"><?php echo $user['full_name']; ?></h2>
                        <p class="text-muted mb-0"><?php echo $user['email']; ?> | System ID: #<?php echo $user['id']; ?></p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="admin_panel.php" class="btn btn-dark btn-sm rounded-0 px-4">Back</a>
                    <form method="POST">
                        <input type="hidden" name="current_status" value="<?php echo $user['is_blocked'] ?? 0; ?>">
                        <button type="submit" name="toggle_block" class="btn <?php echo ($user['is_blocked'] ?? 0) == 1 ? 'btn-success' : 'btn-danger'; ?> btn-sm rounded-0 px-4">
                            <?php echo ($user['is_blocked'] ?? 0) == 1 ? 'UNBLOCK' : 'BLOCK'; ?>
                        </button>
                    </form>
                </div>
            </div>

            <div class="data-grid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="data-label">Contact Number</div>
                        <div class="data-value"><?php echo $user['phone'] ?: '<span class="not-added">Not Added</span>'; ?></div>

                        <div class="data-label">Home Address</div>
                        <div class="data-value"><?php echo $user['address'] ?: '<span class="not-added">Not Added</span>'; ?></div>

                        <div class="data-label">CV Print History</div>
                        <div class="data-value text-primary fw-bold"><?php echo $user['cv_print_count'] ?? 0; ?> Generations</div>
                    </div>

                    <div class="col-md-8 border-start ps-lg-5">
                        <div class="data-label">Professional Summary</div>
                        <p class="data-value"><?php echo $user['summary'] ?: '<span class="not-added">User has not provided a profile summary yet.</span>'; ?></p>

                        <h6 class="section-divider">Experience Records</h6>
                        <table class="table-simple mb-4">
                            <thead>
                                <tr><th>Job Title</th><th>Organization</th><th>Years</th></tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($exp) > 0): while($row = mysqli_fetch_assoc($exp)): ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo $row['job_title']; ?></td>
                                        <td><?php echo $row['company'] ?? '<span class="not-added">Not Added</span>'; ?></td>
                                        <td><?php echo $row['years'] ?? '0'; ?></td>
                                    </tr>
                                <?php endwhile; else: echo '<tr><td colspan="3" class="not-added p-3">No work history provided.</td></tr>'; endif; ?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="section-divider">Education</h6>
                                <?php if(mysqli_num_rows($edu) > 0): while($e = mysqli_fetch_assoc($edu)): ?>
                                    <div class="mb-2">
                                        <div class="fw-bold small"><?php echo $e['degree']; ?></div>
                                        <div class="text-muted small"><?php echo $e['institution']; ?></div>
                                    </div>
                                <?php endwhile; else: echo '<span class="not-added">No education records.</span>'; endif; ?>
                            </div>
                            <div class="col-md-6">
                                <h6 class="section-divider">Portfolio Projects</h6>
                                <?php if(mysqli_num_rows($pro) > 0): while($p = mysqli_fetch_assoc($pro)): ?>
                                    <div class="mb-2">
                                        <div class="fw-bold small"><?php echo $p['project_title']; ?></div>
                                        <div class="text-muted small"><?php echo $p['description'] ?? 'No Description'; ?></div>
                                    </div>
                                <?php endwhile; else: echo '<span class="not-added">No projects added.</span>'; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>