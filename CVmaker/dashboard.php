<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

$user_id = $_SESSION['user_id'];
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($user_query);

// --- LOGIC: Determine if we are starting fresh or editing ---
$mode = isset($_SESSION['cv_mode']) ? $_SESSION['cv_mode'] : 'edit';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Pro CV Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* YOUR ORIGINAL STYLES PRESERVED EXACTLY */
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background: #212529; color: white; padding-top: 20px; }
        .nav-link { color: #adb5bd; transition: 0.3s; margin-bottom: 10px; }
        .nav-link:hover, .nav-link.active { color: white; background: #343a40; border-radius: 5px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-primary { background: #4e73df; border: none; border-radius: 8px; padding: 10px 20px; }

        /* --- MOBILE RESPONSIVENESS (ONLY FOR CONTENT) --- */
        @media (max-width: 768px) {
            .p-5 { padding: 20px !important; }
            /* Stack columns 100% on mobile */
            .col-md-6, .col-md-4, .col-md-12 {
                width: 100% !important;
            }
            .text-end {
                text-align: center !important;
            }
            .btn {
                width: 100% !important;
                margin: 5px 0 !important;
            }
            .footer .mt-4{
display:none;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar d-none d-md-block">
            <h4 class="text-center mb-4">CV Builder</h4>
            <ul class="nav flex-column px-3">
                <li class="nav-item"><a class="nav-link active" href="dashboard.php"><i class="fas fa-user me-2"></i> Personal</a></li>
                <li class="nav-item"><a class="nav-link" href="education.php"><i class="fas fa-graduation-cap me-2"></i> Education</a></li>
                <li class="nav-item"><a class="nav-link" href="experience.php"><i class="fas fa-briefcase me-2"></i> Experience</a></li>
                <li class="nav-item"><a class="nav-link" href="skills.php"><i class="fas fa-code me-2"></i> Skills</a></li>
                <li class="nav-item"><a class="nav-link" href="projects.php"><i class="fas fa-tasks me-2"></i> Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="languages.php"><i class="fas fa-language me-2"></i> Languages</a></li>
                <li class="nav-item"><a class="nav-link" href="certificate.php"><i class="fas fa-certificate me-2"></i> Certificates</a></li>
                <li class="nav-item"><a class="nav-link" href="interests.php"><i class="fas fa-heart me-2"></i> Interests</a></li>
                <hr>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h2>Welcome, <?php echo $user['full_name']; ?> 👋</h2>
                <div class="badge bg-info text-dark p-2 mb-2">
                    Mode: <?php echo ($mode == 'new') ? 'Updating Cv records' : 'Updating Existing CV'; ?>
                </div>
                <a href="preview.php" class="btn btn-outline-dark mb-2"><i class="fas fa-eye me-2"></i> Preview CV</a>
            </div>

            <div class="card p-4">
                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-id-card me-2"></i>Personal Information</h5>
                <form action="save_logic.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="<?php echo $user['full_name']; ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" class="form-control bg-light" value="<?php echo $user['email']; ?>" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Professional Title (Field)</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Full Stack Developer" 
                            value="<?php echo (isset($user['title'])) ? $user['title'] : ''; ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+92 XXX XXXXXXX"
                            value="<?php echo (isset($user['phone'])) ? $user['phone'] : ''; ?>">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Location / Address</label>
                            <input type="text" name="address" class="form-control" placeholder="City, Country"
                            value="<?php echo (isset($user['address'])) ? $user['address'] : ''; ?>">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Professional Summary</label>
                            <textarea name="summary" class="form-control" rows="4"><?php echo (isset($user['summary'])) ? $user['summary'] : ''; ?></textarea>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">LinkedIn URL</label>
                            <input type="url" name="linkedin" class="form-control"
                            value="<?php echo (isset($user['linkedin'])) ? $user['linkedin'] : ''; ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Portfolio/Website</label>
                            <input type="url" name="portfolio" class="form-control"
                            value="<?php echo (isset($user['portfolio'])) ? $user['portfolio'] : ''; ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Profile Picture</label>
                            <input type="file" name="profile_img" class="form-control">
                        </div>
                    </div>

                    <div class="text-end mt-3 border-bottom pb-4">
                        <button type="submit" name="save_personal" class="btn btn-primary px-5 shadow-sm">
                            <i class="fas fa-save me-2"></i>
                            <?php echo ($mode == 'new') ? 'Save New CV' : 'Update Profile'; ?>
                        </button>
                        
                        <a href="education.php" class="btn btn-dark px-5 shadow-sm ms-md-2">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </form>

                <div class="mt-5">
                    <h6 class="fw-bold text-muted mb-3 text-center text-md-start"><i class="fas fa-layer-group me-2"></i> Jump to Other Sections</h6>
                    <div class="row g-2">
                        <div class="col-6 col-md-3">
                            <a href="education.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-graduation-cap d-block mb-1"></i> Education</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="experience.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-briefcase d-block mb-1"></i> Experience</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="skills.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-code d-block mb-1"></i> Skills</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="projects.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-tasks d-block mb-1"></i> Projects</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="languages.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-language d-block mb-1"></i> Languages</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="certificate.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-certificate d-block mb-1"></i> Certificates</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="interests.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-heart d-block mb-1"></i> Interests</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include("footer.php"); ?>