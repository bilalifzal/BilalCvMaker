<?php
include 'config.php';
session_start();

// SECURITY: Same as original
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

$user_id = $_SESSION['user_id'];

// --- LOGIC: FETCHING DATA FROM "VERSION 2" TABLES ---
// We fetch from 'users' for personal info, but you can create 'users2' 
// if you want different personal info for the second CV.
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($user_query);

// Logic for saving (Update this to point to your new tables if needed)
if (isset($_POST['save_personal'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $summary = mysqli_real_escape_string($conn, $_POST['summary']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);

    // THE LOGIC CHANGE: You can either update the same user or a new table 'personal_info2'
    $query = "UPDATE users SET 
              full_name = '$full_name', 
              job_title = '$job_title', 
              phone = '$phone', 
              summary = '$summary', 
              linkedin = '$linkedin' 
              WHERE id = '$user_id'";
    
    if (mysqli_query($conn, $query)) {
        $message = "<div class='alert alert-success shadow-sm'>Second CV Profile Updated!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New CV Dashboard | Pro CV Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* KEEPING YOUR EXACT ORIGINAL DESIGN */
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, sans-serif; }
        .sidebar { min-height: 100vh; background: #212529; color: white; padding-top: 20px; }
        .nav-link { color: #adb5bd; transition: 0.3s; margin-bottom: 10px; }
        .nav-link:hover, .nav-link.active { color: white; background: #343a40; border-radius: 5px; }
        .main-content { padding: 40px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .badge-new { background: #1cc88a; color: white; font-size: 0.7rem; padding: 3px 8px; border-radius: 5px; margin-left: 5px; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar px-3">
            <h4 class="text-center fw-bold mb-4 text-primary">CV MAKER <span class="badge-new">V2</span></h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="dashboard2.php"><i class="fas fa-user me-2"></i> Personal Info</a></li>
                <li class="nav-item"><a class="nav-link" href="education2.php"><i class="fas fa-graduation-cap me-2"></i> Education</a></li>
                <li class="nav-item"><a class="nav-link" href="experience2.php"><i class="fas fa-briefcase me-2"></i> Experience</a></li>
                <li class="nav-item"><a class="nav-link" href="skills2.php"><i class="fas fa-tools me-2"></i> Skills</a></li>
                <li class="nav-item"><a class="nav-link" href="projects2.php"><i class="fas fa-project-diagram me-2"></i> Projects</a></li>
                <hr>
                <li class="nav-item"><a class="nav-link text-info" href="useracc.php"><i class="fas fa-arrow-left me-2"></i> Back to Account</a></li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Editing New CV (Version 2) 👋</h2>
                <a href="preview2.php" class="btn btn-outline-dark"><i class="fas fa-eye me-2"></i> Preview New CV</a>
            </div>

            <?php if(isset($message)) echo $message; ?>

            <div class="card p-4">
                <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-user-circle me-2"></i>Personal Details</h5>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="<?php echo $user['full_name']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Job Title</label>
                            <input type="text" name="job_title" class="form-control" value="<?php echo $user['job_title']; ?>" placeholder="e.g. Senior Developer">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $user['phone']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">LinkedIn URL</label>
                            <input type="url" name="linkedin" class="form-control" value="<?php echo $user['linkedin']; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Professional Summary</label>
                            <textarea name="summary" class="form-control" rows="4"><?php echo $user['summary']; ?></textarea>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" name="save_personal" class="btn btn-primary px-5 shadow-sm">
                            <i class="fas fa-save me-2"></i>Save for CV #2
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>